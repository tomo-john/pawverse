<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Dog;
use App\Services\Dashboard\DogBehaviorService;

class World extends Component
{
    public $dogs;
    public $selectedDog;
    public $behavior;

    protected DogBehaviorService $service;

    public function boot(DogBehaviorService $service)
    {
        $this->service = $service;
    }

    public function mount()
    {
        $this->dogs = auth()->user()->dogs()->with('status')->get();

        if ($this->dogs->isNotEmpty()) {
            $this->selectedDog = $this->dogs->random();
            $this->behavior = $this->service->resolveBehavior($this->selectedDog);
        }
    }

    public function render()
    {
        return view('livewire.dashboard.world')
            ->layout('components.layouts.app');
    }
}
