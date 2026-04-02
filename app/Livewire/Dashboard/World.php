<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class World extends Component
{
    public function render()
    {
        return view('livewire.dashboard.world')
            ->layout('components.layouts.app');
    }
}
