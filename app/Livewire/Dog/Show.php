<?php

namespace App\Livewire\Dog;

use Livewire\Component;
use App\Models\Dog;

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

    public function startAnimation(string $type, int $seconds = 2)
    {
        $this->activeAnimation = $type;
        $this->animationUntil = now()->addSeconds($seconds);
    }

    public function checkAnimation()
    {
        if ($this->animationUntil && now()->greaterThan($this->animationUntil)) {
            $this->activeAnimation = null;
            $this->animationUntil = null;
        }
    }

    public function render()
    {
        return view('livewire.dog.show');
    }

}
