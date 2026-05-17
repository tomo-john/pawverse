<?php

namespace App\Livewire\Dog;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Dog;
use Illuminate\Support\Collection;

class Village extends Component
{
    public $name;
    public $size_level = null;

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

    public function render()
    {
        return view('livewire.dog.village.index')
            ->layout('components.layouts.app');
    }
}
