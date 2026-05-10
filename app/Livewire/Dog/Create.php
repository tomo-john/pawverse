<?php

namespace App\Livewire\Dog;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use App\Models\Dog;

class Create extends Component
{
    public function render()
    {
        return view('livewire.dog.create')
            ->layout('components.layouts.app');
    }
}
