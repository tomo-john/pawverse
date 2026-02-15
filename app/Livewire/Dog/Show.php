<?php

namespace App\Livewire\Dog;

use Livewire\Component;
use App\Models\Dog;

class Show extends Component
{
    public Dog $dog;

    public $breed;
    public $sex;
    public $personality;
    public $birthday;
    public $photo_path;

    public $showModal = false;

    public function mount(Dog $dog)
    {
        $this->dog = $dog;
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function save()
    {
        $this->dog->realDog()->updateOrCreate(
            ['dog_id' => $this->dog->id],
            [
                'breed' => $this->breed,
                'sex' => $this->sex,
                'personality' => $this->personality,
            ]
        );

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.dog.show');
    }
}
