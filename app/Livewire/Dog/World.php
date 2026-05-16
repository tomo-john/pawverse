<?php

namespace App\Livewire\Dog;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Dog;

class World extends Component
{
    public $dogs;

    public function mount()
    {
        $this->dogs = auth()->user()->dogs()->with('status')->get();
    }

    public function render()
    {
        return view('livewire.dog.world')
            ->layout('components.layouts.app');
    }
}
