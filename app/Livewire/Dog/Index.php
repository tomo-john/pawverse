<?php

namespace App\Livewire\Dog;

use Livewire\Component;
use App\Models\Dog as DogModel;

class Index extends Component
{
    // プロパティ
    public $name;
    public $color = '#000000';
    public $size_level = 5;
    public $met_at;
    public $is_public;
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

    // バリデーションルール
    protected function rules(): array
    {
        return [
            'name'        => 'required|string|max:20',
            'color'       => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'size_level'  => 'required|integer|min:1|max:9',
            'met_at'      => 'nullable|date',
            'is_public'   => 'required|boolean',
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
            'met_at'      => $this->met_at ?:null,
            'is_public'   => $this->is_public ?? false,
        ];
    }

    // フォームリセット
    public function resetForm(): void
    {
        $this->reset([
            'name',
            'met_at',
        ]);

        // デフォルト値
        $this->color = '#000000';
        $this->size_level = 5;
        $this->is_public = false;
        $this->editingId = null;
    }

    // 保存用メソッド
    public function save(): void
    {
        $this->validateDog();

        if ($this->editingId) {
            $dog = DogModel::findOrFail($this->editingId);
            $this->authorize('update', $dog);
            $dog->update($this->dogPayload());
            $this->dogs = $this->dogs->map(
                fn($d) => $d->id === $dog->id ? $dog : $d
            );
        } else {
            $dog = DogModel::create($this->dogPayload());
            $this->dogs = $this->dogs->prepend($dog);
        }

        $this->dispatch('notify',
            message: $this->editingId ? '更新しました' : '登録しました',
            variant: 'success'
        );

        $this->resetForm();
    }

    // 編集用フォーム
    public function edit(int $id): void
    {
        $dog = DogModel::findOrFail($id);
        $this->authorize('update', $dog);

        $this->editingId = $dog->id;
        $this->name = $dog->name;
        $this->color = $dog->color;
        $this->size_level = $dog->size_level;
        $this->met_at = optional($dog->met_at)->format('Y-m-d');
        $this->is_public = $dog->is_public;
    }

    // 削除処理
    public function delete(int $id): void
    {
        $dog = DogModel::findOrFail($id);
        $this->authorize('delete', $dog);
        $dog->delete();
        $this->dogs = $this->dogs->reject(
            fn($d) => $d->id === $id
        );

        $this->dispatch('notify',
            message: 'お別れしました...',
            variant: 'danger'
        );
        // $this->resetForm();
    }

    // Blade
    public function render()
    {
        return view('livewire.dog.index');
    }
}
