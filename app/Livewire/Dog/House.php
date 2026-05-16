<?php

namespace App\Livewire\Dog;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use App\Models\Dog;
use App\Domain\Dog\DogAnimationDefinition;
use App\Services\Dog\DogMessageService;

class House extends Component
{
    public Dog $dog;
    public ?string $activeAnimation = null;
    public ?string $animationUntil = null;

    protected DogMessageService $service;

    public function boot(DogMessageService $service)
    {
        $this->service = $service;
    }

    public function mount(Dog $dog)
    {
        $this->authorize('view', $dog);
        $this->dog = $dog;
        $this->showMessage();
    }

    public function startAnimation(string $reaction)
    {
        $def = DogAnimationDefinition::get($reaction);

        $this->activeAnimation = $reaction;
        $this->animationUntil = now()->addSeconds($def['duration']);
    }

    public function checkAnimation()
    {
        if (! $this->animationUntil) {
            return;
        }

        if (now()->greaterThan($this->animationUntil)) {
            $this->activeAnimation = null;
            $this->animationUntil = null;
        }
    }

    public function showMessage()
    {
        $message = $this->service->message($this->dog);

        $this->dispatch('message-show', message: $message);
    }

    #[On('dog-reacted')]
    public function onDogReacted(string $reaction)
    {
        $this->startAnimation($reaction);
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
        return view('livewire.dog.house')
            ->layout('components.layouts.app');
    }

}
