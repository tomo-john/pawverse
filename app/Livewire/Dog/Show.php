<?php

namespace App\Livewire\Dog;

use Livewire\Component;
use App\Models\Dog;

class Show extends Component
{
    public Dog $dog;

    public function mount(Dog $dog)
    {
        $this->dog = $dog;
    }

    public function render()
    {
        return view('livewire.dog.show');
    }
}
