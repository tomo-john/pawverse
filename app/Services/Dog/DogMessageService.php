<?php

namespace App\Services\Dog;

use App\Models\Dog;
use App\Domain\Dog\DogMessageDefinition;

class DogMessageService
{
    public function message(Dog $dog): string
    {
        $status = $dog->status;

        if ($status->happy < 100) {
            return $this->random('happy_low');
        }

        if ($status->hunger > 80) {
            return $this->random('hunger_high');
        }

        if ($status->stamina < 50) {
            return $this->random('stamina_low');
        }

        if ($status->happy > 400) {
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
