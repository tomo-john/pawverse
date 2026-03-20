<?php

namespace App\Livewire\Dog;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use App\Models\Dog;
use App\Domain\Dog\DogAnimationDefinition;

class Show extends Component
{
    public Dog $dog;
    public ?string $activeAnimation = null;
    public ?string $animationUntil = null;

    public function mount(Dog $dog)
    {
        $this->authorize('view', $dog);
        $this->dog = $dog;
    }

    public function startAnimation(string $type, int $seconds = null)
    {
        $def = DogAnimationDefinition::get($type);
        $duration = $seconds ?? ($def['duration'] ?? 2);

        $this->activeAnimation = $type;
        $this->animationUntil = now()->addSeconds($duration);
    }

    public function checkAnimation()
    {
        if ($this->animationUntil && now()->greaterThan($this->animationUntil)) {
            $this->activeAnimation = null;
            $this->animationUntil = null;
        }
    }

    #[On('dog-reacted')]
    public function onDogReacted(string $type)
    {
        $this->startAnimation($type);
    }

    #[Computed]
    public function animationClass(): string
    {
        if (!$this->activeAnimation) {
            return '';
        }

        return DogAnimationDefinition::get($this->activeAnimation)['class'] ?? '';
    }

    public function render()
    {
        return view('livewire.dog.show');
    }

}
