<?php

namespace App\Livewire\Dog\Show;

use Livewire\Component;
use App\Models\Dog;
use App\Domain\Dog\DogStatusDefinition;
use App\Domain\Dog\DogLevelDefinition;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;

class StatusPanel extends Component
{
    public Dog $dog;

    public function mount(Dog $dog)
    {
        $this->dog = $dog;
        $this->dog->load('status');
    }

    #[Computed]
    public function bars()
    {
        $bars = [];
        foreach (DogStatusDefinition::getBars() as $key => $def) {
            $value = $this->dog->status->$key;
            $bars[$key] = [
                ...$def,
                'value' => $value,
                'percent' => $value / $def['max'] * 100,
            ];
        }
        return $bars;
    }

    #[Computed]
    public function expRemaining()
    {
        return DogLevelDefinition::expRemaining(
            $this->dog->status->level,
            $this->dog->status->exp
        );
    }

    #[On('dog-updated')]
    public function refreshDog()
    {
        $this->dog->refresh();
    }

    public function render()
    {
        return view('livewire.dog.show.status-panel');
    }
}
