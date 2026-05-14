<?php

namespace App\Livewire\Dog;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Dog;
use App\Services\Dog\DogBehaviorService;

class World extends Component
{
    public $dogs;
    public $behaviors = [];

    protected DogBehaviorService $service;

    public function boot(DogBehaviorService $service)
    {
        $this->service = $service;
    }

    public function mount()
    {
        $this->dogs = auth()->user()->dogs()->with('status')->get();

        if ($this->dogs->isNotEmpty()) {
            foreach ($this->dogs as $dog) {
                $this->behaviors[$dog->id] = $this->service->resolveBehavior($dog);
            }
        }
    }

    public function render()
    {
        return view('livewire.dog.world')
            ->layout('components.layouts.app');
    }
}
