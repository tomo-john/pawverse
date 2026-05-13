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
        if ($this->step === 1 && !$this->hasCustomName) {
            $this->dispatch('message', text: 'まだ名前がないみたいだわん...');
            return;
        }

        if ($this->step === 2 && !$this->hasCustomColor) {
            $this->dispatch('message', text: '毛色を選んでほしいわん');
            return;
        }

        if ($this->step === 3 && !$this->hasCustomSize) {
            $this->dispatch('message', text: 'サイズを選んでほしいわん');
            return;
        }

        if ($this->step === 4 && !$this->hasCustomIsPublic) {
            return;
        }

        $this->step++;
        $this->dispatch('message-clear');
    }

    public function prevStep(): void
    {
        $this->step--;
        $this->dispatch('message-clear');
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
            5 => 'あの子が、こっちを見てるわん...',
            default => 'pawverseの世界へようこそ',
        };
    }

    #[Computed]
    public function sizeClass(): string
    {
        return Dog::SIZE_CLASSES[$this->size_level] ?? 'text-5xl';
    }

    #[Computed]
    public function dogClasses(): string
    {
        $classes = ['fa-solid', 'fa-dog', 'transition-all', 'duration-500', 'inline-block'];

        $classes[] = $this->hasCustomSize ? $this->sizeClass : 'text-5xl';

        $classes[] = match(true) {
            $this->step === 5 && $this->canSave => 'opacity-100 animate-bounce',
            $this->step === 4 => 'opacity-80 animate-pulse',
            $this->step === 3 => 'opacity-60 animate-pulse',
            $this->step === 2 && $this->hasCustomColor => 'opacity-40 animate-pulse',
            $this->step >= 1 && $this->hasCustomName => 'opacity-20 animate-pulse',
            default => 'opacity-0',
        };

        $classes[] = match(true) {
            $this->step === 5 => 'rotate-0',
            $this->is_public === true => '-rotate-6',
            $this->is_public === false => 'rotate-6',
            default => 'rotate-0',
        };

        return implode(' ', $classes);
    }

    #[Computed]
    public function houseClasses(): string
    {
        $classes = ['fa-solid', 'fa-house', 'text-9xl', 'transition-all', 'duration-500'];

        $classes[] = ($this->step === 5 && $this->canSave)
            ? 'text-amber-300 drop-shadow-lg'
            : 'text-gray-300';

        if($this->step === 5) {
            $classes[] = 'opacity-100';
        } else {
            $classes[] = 'animate-pulse';
            $classes[] = $this->hasCustomSize ? 'opacity-60' : 'opacity-30';
        }

        return implode(' ', $classes);
    }

    #[Computed]
    public function worldItems(): array
    {
        return [
            [
                'icon' => 'fa-solid fa-bone',
                'pos'  => 'top-30 right-55',
                'step' => 1,
            ],
            [
                'icon' => 'fa-solid fa-football',
                'pos'  => 'bottom-30 left-40',
                'step' => 2,
            ],
            [
                'icon' => 'fa-solid fa-bicycle',
                'pos'  => 'bottom-5 right-5',
                'step' => 3,
            ],
            [
                'icon' => 'fa-solid fa-baseball-ball',
                'pos'  => 'top-15 right-15',
                'step' => 4,
            ],
            [
                'icon' => 'fa-solid fa-bowl-food',
                'pos'  => 'top-25 left-70',
                'step' => 5,
            ],
        ];
    }

    #[Computed]
    public function canSave(): bool
    {
        return $this->hasCustomName
            && $this->hasCustomColor
            && $this->hasCustomSize
            && $this->hasCustomIsPublic;
    }

    public function render()
    {
        return view('livewire.dog.create')
            ->layout('components.layouts.app');
    }
}
