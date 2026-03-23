<?php

namespace App\Livewire\Dog;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Dog as DogModel;

class Index extends Component
{
    public $name;
    public $color = '#000000';
    public $size_level = 5;
    public $is_public = false;
    public $editingId = null;
    public $dogs;

    public function mount()
    {
        $this->dogs = auth()->user()
            ->dogs()
            ->latest()
            ->get();

    }

    #[Computed]
    public function sizeClass(): string
    {
        return DogModel::SIZE_CLASSES[$this->size_level] ?? 'text-5xl';
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
            'is_public'   => $this->is_public ?? false,
        ];
    }

    public function resetForm(): void
    {
        $this->reset([
            'name',
        ]);

        $this->color = '#000000';
        $this->size_level = 5;
        $this->is_public = false;
        $this->editingId = null;
    }

    public function save(): void
    {
        try {
            $this->validate();

            if ($this->editingId) {
                $dog = DogModel::findOrFail($this->editingId);
                $this->authorize('update', $dog);
                $dog->update($this->dogPayload());
                $this->dogs = $this->dogs->map(
                    fn($d) => $d->id === $dog->id ? $dog : $d
                );
            } else {
                $dog = DogModel::create($this->dogPayload());
                $this->dogs = $this->dogs->prepend($dog);
            }

            $this->dispatch('notify',
                message: $this->editingId ? '更新しました' : '登録しました',
                variant: 'success'
            );

        } catch (\Throwable $e) {
            logger($e);
            dd($e->getMessage());
        }

        $this->resetForm();
    }

    public function edit(int $id): void
    {
        $dog = DogModel::findOrFail($id);
        $this->authorize('update', $dog);

        $this->editingId = $dog->id;
        $this->name = $dog->name;
        $this->color = $dog->color;
        $this->size_level = $dog->size_level;
        $this->is_public = $dog->is_public;
    }

    public function delete(int $id): void
    {
        $dog = DogModel::findOrFail($id);
        $this->authorize('delete', $dog);
        $dog->delete();
        $this->dogs = $this->dogs->reject(
            fn($d) => $d->id === $id
        );

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
