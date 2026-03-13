<?php

namespace App\Livewire\Dog\Show;

use Livewire\Component;
use App\Models\Dog;
use App\Domain\Dog\DogStatusDefinition;
use Livewire\Attributes\On;

class StatusPanel extends Component
{
    public Dog $dog;
    public array $bars;

    public function mount(Dog $dog)
    {
        $this->dog = $dog;
        $this->bars = $this->getBarProperty();
        $this->dog->load('status');
    }

    public function getBarProperty()
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
