<?php

namespace App\Livewire\Dog\Show;

use Livewire\Component;
use App\Models\Dog;
use App\Services\Dog\DogTimelineService;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;

class Timeline extends Component
{
    public Dog $dog;
    public int $dogId;
    public Collection $timeline;
    protected DogTimelineService $service;

    public function boot(DogTimelineService $service)
    {
        $this->service = $service;
    }

    public function mount(Dog $dog)
    {
        $this->dog = $dog;
        $this->dogId = $dog->id;
        $this->timeline = $this->service->timeline($dog->id);
    }

    public function updatedDog(int $dogId)
    {
        $this->timeline = $this->service->timeline($dogId);
    }

    public function render()
    {
        return view('livewire.dog.show.timeline');
    }
}
