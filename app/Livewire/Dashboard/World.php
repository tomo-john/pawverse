<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Dog;

class World extends Component
{
    public $dogs;
    public $selectedDog;

    public function mount()
    {
        $this->dogs = auth()->user()->dogs()->with('status')->get();

        if ($this->dogs->isNotEmpty()) {
            $this->selectedDog = $this->dogs->random();
        }
    }

    public function render()
    {
        return view('livewire.dashboard.world')
            ->layout('components.layouts.app');
    }
}
