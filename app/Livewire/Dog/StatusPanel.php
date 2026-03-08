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
    }

    // ステータス変更イベント感知
    #[On('dog-status-updated')]
    public function refreshDog()
    {
        $this->dog->refresh();
    }

    public function render()
    {
        return view('livewire.dog.status-panel');
    }
}
