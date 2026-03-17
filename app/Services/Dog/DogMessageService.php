<?php

namespace App\Services\Dog;

use App\Models\Dog;
use App\Domain\Dog\DogMessageDefinition;
use App\Domain\Dog\DogStatusDefinition;

class DogMessageService
{
    public function message(Dog $dog): string
    {
        foreach (DogMessageDefinition::rules() as [$status, $state, $type]) {

            $value = $dog->status->$status;

            if (DogStatusDefinition::state($status, $value) === $state) {
                return $this->random($type);
            }
        }

        return $this->random('default');
    }

    public function random(string $type): string
    {
        $messages = DogMessageDefinition::get($type);

        return $messages[array_rand($messages)];
    }

}
