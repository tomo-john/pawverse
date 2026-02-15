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
        $this->dog = $dog->load('realDog');
    }

    public function openModal()
    {
        $this->fillRealDogForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->resetValidation();
        $this->fillRealDogForm();
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

    public function fillRealDogForm() :void
    {
        if ($this->dog->realDog) {
            $this->breed = $this->dog->realDog->breed;
            $this->sex = $this->dog->realDog->sex;
            $this->personality = $this->dog->realDog->personality;
        } else {
            $this->reset(['breed', 'sex', 'personality']);
        }
    }

    public function render()
    {
        return view('livewire.dog.show');
    }
}
