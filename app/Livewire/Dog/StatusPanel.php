<?php

namespace App\Livewire\Dog;

use Livewire\Component;
use App\Models\Dog;
use Livewire\Attributes\On;

class StatusPanel extends Component
{
    public Dog $dog;

    public function mount(Dog $dog)
    {
        $this->dog = $dog;
        $this->dog->load('status');
    }

    #[On('dog-updated')]
    public function refreshDog()
    {
        $this->dog->refresh();
    }

    public function render()
    {
        return view('livewire.dog.status-panel');
    }
}
