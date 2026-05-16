<?php

namespace App\Livewire\Dog\House;

use Livewire\Component;
use App\Models\Dog;
use App\Models\RealDog;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class RealDogCard extends Component
{
    use WithFileUploads;

    public Dog $dog;
    public $breed;
    public $sex;
    public $personality;
    public $birthday;
    public $photo;
    public $showModal = false;
    public array $personalities = [];

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

    // photo削除メソッド
    public function removePhoto()
    {
        $path = $this->dog->realDog?->photo_path;

        if ($path) {
            Storage::disk('public')->delete($path);
            $this->dog->realDog->update(['photo_path' => null]);
            $this->dog->refresh();
        }
    }

    // photo保存メソッド
    protected function storePhoto(): ?string
    {
        if (!$this->photo) {
            return null;
        }

        $oldPath = $this->dog->realDog?->photo_path;

        if ($oldPath) {
            Storage::disk('public')->delete($oldPath);
        }

        return $this->photo->store('dogs/avatar','public');
    }

    // バリデーションルール
    protected function rules(): array
    {
        $personalityKeys = implode(',', array_keys(RealDog::PERSONALITIES));

        return [
            'breed'       => 'nullable|string|max:50',
            'sex'         => 'nullable|in:male,female',
            'personality' => "nullable|in:$personalityKeys",
            'birthday'    => 'nullable|date|before_or_equal:today',
            'photo'       => 'nullable|image|max:2048',
        ];
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
        $this->validate();

        // 保存データを準備
        $data = $this->realDogPayload();

        // 画像があるときだけ保存
        if ($path = $this->storePhoto()) {
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

        // イベント発火
        $this->dispatch('dog-updated');
    }

    public function render()
    {
        return view('livewire.dog.house.real-dog-card');
    }
}
