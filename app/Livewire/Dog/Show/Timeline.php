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
    public Collection $timeline;

    protected DogTimelineService $service;

    public function boot(DogTimelineService $service)
    {
        $this->service = $service;
    }

    public function mount(Dog $dog)
    {
        $this->dog = $dog;
        $this->loadTimeline();
    }

    #[On('dog-updated')]
    public function refreshTimeline()
    {
        $this->loadTimeline();
    }

    private function loadTimeline()
    {
        $this->timeline = $this->service->timeline($this->dog->id);
    }

    public function render()
    {
        return view('livewire.dog.show.timeline');
    }
}
