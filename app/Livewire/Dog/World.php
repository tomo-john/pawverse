<?php

namespace App\Livewire\Dog;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Dog;

class World extends Component
{
    public $dogs;
    public $size_level = null;

    public function mount()
    {
        $this->dogs = auth()->user()->dogs()->with('status')->get();
    }

    #[Computed]
    public function sizeClass(): string
    {
        return Dog::SIZE_CLASSES[$this->size_level] ?? 'text-5xl';
    }

    public function render()
    {
        return view('livewire.dog.world.index')
            ->layout('components.layouts.app');
    }
}
