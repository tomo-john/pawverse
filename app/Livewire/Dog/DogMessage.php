<?php

namespace App\Livewire\Dog;

use Livewire\Component;
use App\Models\Dog;
use App\Services\Dog\DogMessageService;
use Livewire\Attributes\On;

class DogMessage extends Component
{
    public Dog $dog;
    public string $message;

    protected DogMessageService $service;

    public function boot(DogMessageService $service)
    {
        $this->service = $service;
    }

    public function mount(Dog $dog)
    {
        $this->dog = $dog;
        $this->loadMessage();
    }

    public function loadMessage()
    {
        $this->message = $this->service->message($this->dog);
    }

    #[On('dog-updated')]
    public function refreshDog()
    {
        $this->dog->refresh();
        $this->loadMessage();
    }

    public function render()
    {
        return view('livewire.dog.dog-message');
    }
}
