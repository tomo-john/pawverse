<?php

namespace App\Livewire\Dog\Show;

use Livewire\Component;
use App\Models\Dog;
use App\Services\Dog\DogTimelineService;
use Illuminate\Support\Collection;

class Timeline extends Component
{
    public Dog $dog;
    public ?Collection $timeline = null;
    protected DogTimelineService $service;

    public function boot(DogTimelineService $service)
    {
        $this->service = $service;
    }

    public function mount(Dog $dog)
    {
        $this->dog = $dog;
        $this->timeline = $this->service->timeline($dog->id);
    }

    public function render()
    {
        return view('livewire.dog.show.timeline');
    }
}
