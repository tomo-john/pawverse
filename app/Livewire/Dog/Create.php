<?php

namespace App\Livewire\Dog;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use App\Models\Dog;

class Create extends Component
{
    public $name ='';
    public $color = '#cccccc';
    public $size_level = null;
    public $is_public = null;
    public int $step = 0;

    public function mount() :void
    {
        // mount
    }

    public function nextStep(): void
    {
        $this->step++;
    }

    public function prevStep(): void
    {
        $this->step--;
    }

    #[Computed]
    public function currentStep(): int
    {
        if (!$this->hasCustomName)      return 1;
        if (!$this->hasCustomColor)     return 2;
        if (!$this->hasCustomSize)      return 3;
        if (!$this->hasCustomIsPublic)  return 4;

        return 5;
    }

    #[Computed]
    public function hasCustomName(): bool
    {
        return filled($this->name);
    }

    #[Computed]
    public function hasCustomColor(): bool
    {
        return $this->color !== '#cccccc';
    }

    #[Computed]
    public function hasCustomSize(): bool
    {
        return !is_null($this-size_level);
    }

    #[Computed]
    public function hasCustomIsPublic(): bool
    {
        return !is_null($this-is_public);
    }

    #[Computed]
    public function consoleMessage(): string
    {
        return match($this->step) {
            0 => 'あの子のこと教えてほしいわん',
            1 => '名前を教えてほしいわん',
            2 => '毛色を教えてほしいわん',
            3 => '大きさを教えてほしいわん',
            4 => '公開するかを教えてほしいわん',
            default => '🐶',
        };
    }

    #[Computed]
    public function canSave(): bool
    {
        return $this->currentStep >= 5;
    }

    public function render()
    {
        return view('livewire.dog.create')
            ->layout('components.layouts.app');
    }
}
