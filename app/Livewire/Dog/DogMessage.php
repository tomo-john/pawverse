<?php

namespace App\Livewire\Dog;

use Livewire\Component;
use App\Models\Dog;
use App\Services\Dog\DogMessageService;

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
        $this->message = $this->service->message($dog);
    }

    public function render()
    {
        return view('livewire.dog.dog-message');
    }
}
