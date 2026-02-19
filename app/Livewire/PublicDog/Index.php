<?php

namespace App\Livewire\PublicDog;

use Livewire\Component;
use App\Models\Dog;

class Index extends Component
{
    public $dogs;

    public function mount()
    {
        $this->dogs = Dog::query()
            ->where('is_public', true)
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.public-dog.index');
    }
}
