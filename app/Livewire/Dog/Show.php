<?php

namespace App\Livewire\Dog;

use Livewire\Component;
use App\Models\Dog;
use App\Models\RealDog;

class Show extends Component
{
    // プロパティ
    public Dog $dog;

    public $breed;
    public $sex;
    public $personality;
    public $birthday;
    public $photo_path;

    public $showModal = false;

    public array $personalities = [];

    // マウント
    public function mount(Dog $dog)
    {
        $this->dog = $dog;
        $this->dog->load('realDog');
        $this->personalities = RealDog::PERSONALITIES;
    }

    // モーダルオープン
    public function openModal()
    {
        $this->fillRealDogForm();
        $this->showModal = true;
    }

    // モーダルクローズ
    public function closeModal()
    {
        $this->resetValidation();
        $this->fillRealDogForm();
        $this->showModal = false;
    }

    // 保存処理
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
        $this->dog->load('realDog');
        $this->closeModal();
    }

    // モーダルの入力値
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

    // レンダー
    public function render()
    {
        return view('livewire.dog.show');
    }
}
