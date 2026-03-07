<?php

namespace App\Livewire\Dog;

use Livewire\Component;
use App\Models\Dog;
use App\Models\RealDog;
use App\Domain\Dog\DogActionDefinition;
use App\Services\Dog\DogActionService;
use App\Services\Dog\DogCooldownService;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    use WithFileUploads;
    use WithPagination;

    // プロパティ
    public Dog $dog;

    public $breed;
    public $sex;
    public $personality;
    public $birthday;
    public $photo;

    public $showModal = false;

    public array $personalities = [];
    public array $cooldowns = [];

    // bootでDI
    protected DogCooldownService $cooldownService;

    public function boot(DogCooldownService $cooldownService)
    {
        $this->cooldownService = $cooldownService;
    }

    // 初期化処理
    public function mount(Dog $dog)
    {
        $this->authorize('view', $dog);
        $this->dog = $dog;
        $this->dog->load(['realDog', 'status']);
        $this->personalities = RealDog::PERSONALITIES;
        $this->loadCooldowns();
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
    }

    // Action操作
    public function action(string $type, DogActionService $service)
    {
        $service->execute($this->dog, $type);

        $this->dog->refresh();

        $this->loadCooldowns();
    }

    // クールダウンタイム取得
    public function loadCooldowns()
    {
        foreach (DogActionDefinition::all() as $key => $def) {
            $remaining = $this->cooldownService->getRemainingSeconds($this->dog, $key);
            $this->cooldowns[$key] = $remaining;
        }
    }

    // クールダウン判定用
    public function isDisabled(string $action): bool
    {
        return ($this->cooldowns[$action] ?? 0) > 0;
    }

    // クールダウン残り時間フォーマット
    public function cooldownFormatted(string $action): string
    {
        $sec = $this->cooldowns[$action] ?? 0;

        $m = floor($sec / 60);
        $s = $sec % 60;

        return sprintf('%02d:%02d', $m, $s);
    }

    // レンダー
    public function render()
    {
        return view('livewire.dog.show');
    }
}
