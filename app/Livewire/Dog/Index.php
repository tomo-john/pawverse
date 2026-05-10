<?php

namespace App\Livewire\Dog;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Dog;
use Illuminate\Support\Collection;

class Index extends Component
{
    public $name;
    public $color = '#e60076';
    public $size_level = 5;
    public $is_public = false;
    public $editingId = null;

    public function mount() :void
    {
        if (auth()->user()->dogs()->doesntExist()) {
            $this->redirectRoute('dog.create');
        }
    }

    #[Computed]
    public function dogs(): Collection
    {
        $user = auth()->user();

        return $user->dogs()->latest()->get();
    }

    #[Computed]
    public function sizeClass(): string
    {
        return Dog::SIZE_CLASSES[$this->size_level] ?? 'text-5xl';
    }

    public function updatedName(): void
    {
        $this->validateOnly('name');
    }

    protected function rules(): array
    {
        return [
            'name'        => 'required|string|max:20',
            'color'       => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'size_level'  => 'required|integer|min:1|max:9',
            'is_public'   => 'boolean',
        ];
    }

    protected function dogPayload(): array
    {
        return [
            'user_id'     => auth()->id(),
            'name'        => $this->name,
            'color'       => $this->color,
            'size_level'  => $this->size_level,
            'is_public'   => $this->is_public,
        ];
    }

    public function resetForm(): void
    {
        $this->reset([
            'name',
            'editingId',
        ]);

        $this->color = '#e60076';
        $this->size_level = 5;
        $this->is_public = false;
    }

    public function save(): void
    {
        $this->validate();

        try {
            if ($this->editingId) {
                $dog = Dog::findOrFail($this->editingId);
                $this->authorize('update', $dog);
                $dog->update($this->dogPayload());
            } else {
                $dog = Dog::create($this->dogPayload());
            }

            $this->dispatch('notify',
                message: $this->editingId
                    ? 'この子、もっと素敵になったわん🐶✨'
                    : '新しい子を迎えたわん!',
                variant: $this->editingId
                    ? 'info'
                    : 'success',
            );

            $this->resetForm();

        } catch (\Throwable $e) {
            logger($e);

            $this->dispatch('notify',
                message: 'エラーが発生しました🐶💦',
                variant: 'danger'
            );
        }
    }

    public function edit(int $id): void
    {
        $dog = Dog::findOrFail($id);
        $this->authorize('update', $dog);

        $this->editingId = $dog->id;
        $this->name = $dog->name;
        $this->color = $dog->color;
        $this->size_level = $dog->size_level;
        $this->is_public = $dog->is_public;

        $this->dispatch('scroll-to-form');
    }

    public function delete(int $id): void
    {
        $dog = Dog::findOrFail($id);
        $this->authorize('delete', $dog);
        $dog->delete();

        $this->dispatch('notify',
            message: 'お別れしました...',
            variant: 'danger'
        );
    }

    public function render()
    {
        return view('livewire.dog.index')
            ->layout('components.layouts.app');
    }
}
