<?php

namespace App\Livewire\Dog;

use Livewire\Component;
use App\Models\Dog;
use App\Models\RealDog;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    use WithFileUploads;

    // プロパティ
    public Dog $dog;

    public $breed;
    public $sex;
    public $personality;
    public $birthday;
    public $photo;

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
            $this->birthday = $this->dog->realDog?->birthday?->format('Y-m-d');
        } else {
            $this->resetRealDogForm();
        }
    }

    // モーダルのフォームリセット
    public function resetRealDogForm() :void
    {
        $this->reset(['breed', 'sex', 'personality', 'birthday', 'photo']);
    }

    // バリデーションルール
    protected function rules(): array
    {
        return [
            'breed'       => 'nullable|string|max:50',
            'sex'         => 'nullable|in:male,female',
            'personality' => 'nullable|in:' . implode(',', array_keys(RealDog::PERSONALITIES)),
            'birthday'    => 'nullable|date|before_or_equal:today',
            'photo'       => 'nullable|image|max:2048',
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
            'birthday'    => $this->birthday ?: null,
        ];
    }

    // 保存処理
    public function save()
    {
        // バリデーション
        $this->validateRealDog();

        // 保存データを準備
        $data = $this->realDogPayLoad();

        // 画像があるときだけ保存
        if ($this->photo) {

            // 古い画像があれば削除
            if ($this->dog->realDog?->photo_path) {
                Storage::disk('public')->delete($this->dog->realDog->photo_path);
            }

            // 新しい画像を保存
            $path = $this->photo->store('dogs/avatar', 'public');
            $data['photo_path'] = $path;
        }

        // update or create
        $this->dog->realDog()->updateOrCreate(
            ['dog_id' => $this->dog->id],
            $data
        );

        // 再読み込み & 後処理
        $this->dog->load('realDog');
        $this->closeModal();
    }

    // レンダー
    public function render()
    {
        return view('livewire.dog.show');
    }
}
