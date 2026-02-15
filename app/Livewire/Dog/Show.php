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

    // 初期化処理
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

    // モーダルの入力値
    public function fillRealDogForm() :void
    {
        if ($this->dog->realDog) {
            $this->breed = $this->dog->realDog->breed;
            $this->sex = $this->dog->realDog->sex;
            $this->personality = $this->dog->realDog->personality;
        } else {
            $this->resetRealDogForm();
        }
    }

    // モーダルのフォームリセット
    public function resetRealDogForm() :void
    {
        $this->reset(['breed', 'sex', 'personality']);
    }

    // バリデーションルール
    protected function rules(): array
    {
        return [
            'breed'       => 'nullable|string|max:50',
            'sex'         => 'nullable|in:male,female',
            'personality' => 'nullable|in:' . implode(',', array_keys(RealDog::PERSONALITIES))
        ];
    }

    // バリデーションメソッド
    public function validateRealDog(): void
    {
        $this->validate();
    }

    // 保存用配列切り出しメソッド
    protected function realDogPayload(): array
    {
        return [
            'breed'       => $this->breed ?: null,
            'sex'         => $this->sex ?: null,
            'personality' => $this->personality ?: null,
        ];
    }

    // 保存処理
    public function save()
    {
        $this->validateRealDog();
        $this->dog->realDog()->updateOrCreate(
            ['dog_id' => $this->dog->id],
            $this->realDogPayLoad()
        );
        $this->dog->load('realDog');
        $this->closeModal();
    }

    // レンダー
    public function render()
    {
        return view('livewire.dog.show');
    }
}
