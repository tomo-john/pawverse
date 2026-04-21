<?php

namespace App\Services\Dashboard;

use App\Models\Dog;
use App\Domain\Dashboard\DogBehaviorDefinition;

class DogBehaviorService
{
    public function resolveBehavior(Dog $dog): array
    {
        if ($dog->status->stamina < 10) {
            return [
                'type' => 'sleep',
                'speed' => 0,
            ];
        }

        if ($dog->status->stamina < 50) {
            return [
                'type' => 'follow',
                'speed' => 1
            ];
        }

        return [
            'type' => 'wander',
            'speed' => 2,
        ];
    }
}
