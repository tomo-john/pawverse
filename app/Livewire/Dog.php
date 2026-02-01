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

    public $dogs;

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

    // Blade
    public function render()
    {
        return view('livewire.dog');
    }
}
