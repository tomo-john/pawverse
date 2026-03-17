<?php

namespace App\Services\Dog;

use App\Models\Dog;
use App\Domain\Dog\DogMessageDefinition;
use App\Domain\Dog\DogStatusDefinition;

class DogMessageService
{
    public function message(Dog $dog): string
    {
        $status = $dog->status;

        $happyState  = DogStatusDefinition::state('happy', $status->happy);
        $hungerState = DogStatusDefinition::state('hunger', $status->hunger);
        $staminaState = DogStatusDefinition::state('stamina', $status->stamina);

        if ($happyState === 'danger') {
            return $this->random('happy_low');
        }

        if ($hungerState === 'danger') {
            return $this->random('hunger_high');
        }

        if ($staminaState === 'danger') {
            return $this->random('stamina_low');
        }

        if ($happyState === 'full') {
            return $this->random('happy_high');
        }

        return $this->random('default');
    }

    public function random(string $type): string
    {
        $messages = DogMessageDefinition::get($type);

        return $messages[array_rand($messages)];
    }

}
