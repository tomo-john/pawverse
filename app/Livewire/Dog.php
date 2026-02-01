<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Dog as DogModel;

class Dog extends Component
{
    // プロパティ
    public $name;
    public $color = '#000000';
    public $size_level = 5;
    public $met_at;
    public $is_good_boy = true;
    public $editingId = null;

    public $dogs; // 一覧表示用 => テーブルと同期させる

    // 初期化処理
    public function mount()
    {
        $this->dogs = DogModel::latest()->get();
    }

    // sizeクラス
    public function getSizeClassProperty(): string
    {
        return DogModel::SIZE_CLASSES[$this->size_level] ?? 'text-5xl';
    }

    // is_good_boyラベル
    public function getGoodBoyLabelProperty(): string
    {
        return $this->is_good_boy ? 'Good boy 🐶' : 'Naughty dog 😈';
    }

    // バリデーションルール
    protected function rules(): array
    {
        return [
            'name'        => 'required|string|max:20',
            'color'       => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'size_level'  => 'required|integer|min:1|max:9',
            'met_at'      => 'nullable|date',
            'is_good_boy' => 'boolean',
        ];
    }

    // バリデーションメソッド
    protected function validateDog(): void
    {
        $this->validate();
    }

    // 保存用配列切り出しメソッド
    protected function dogPayload(): array
    {
        return [
            'user_id'     => auth()->id(),
            'name'        => $this->name,
            'color'       => $this->color,
            'size_level'  => $this->size_level,
            'met_at'      => $this->met_at,
            'is_good_boy' => $this->is_good_boy,
        ];
    }

    // フォームリセット
    protected function resetForm(): void
    {
        $this->reset([
            'name',
            'met_at',
        ]);

        // デフォルト値
        $this->color = '#000000';
        $this->size_level = 5;
        $this->is_good_boy = true;
        $this->editingId = null;
    }

    // 保存用メソッド
    public function save(): void
    {
        $this->validateDog();

        if ($this->editingId) {

        } else {
            $dog = DogModel::create($this->dogPayLoad());
            $this->dogs = $this->dogs->prepend($dog);
        }

        $this->resetForm();
    }

    // Blade
    public function render()
    {
        return view('livewire.dog');
    }
}
