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
        return !is_null($this->size_level);
    }

    #[Computed]
    public function hasCustomIsPublic(): bool
    {
        return !is_null($this->is_public);
    }

    #[Computed]
    public function consoleMessage(): string
    {
        return match($this->step) {
            0 => 'あの子のこと教えてほしいわん',
            1 => 'あの子の名前は何だったかな',
            2 => 'どんな毛色だったかな',
            3 => 'どれくらいの大きさだったかな',
            4 => 'この子をみんなにもみせてあげる？',
            default => '🐶',
        };
    }

    #[Computed]
    public function sizeClass(): string
    {
        return Dog::SIZE_CLASSES[$this->size_level] ?? 'text-5xl';
    }

    #[Computed]
    public function canSave(): bool
    {
        return $this->hasCustomName
            && $this->hasCustomColor
            && $this->hasCustomSize
            && $this->hasCustomIsPublic
    }

    public function render()
    {
        return view('livewire.dog.create')
            ->layout('components.layouts.app');
    }
}
