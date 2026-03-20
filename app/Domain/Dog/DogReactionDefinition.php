<?php

namespace App\Domain\Dog;

class DogReactionDefinition
{
    public static function map(string $action): string
    {
        return match ($action) {
            'pet'      => 'happy',
            'snack'    => 'eat',
            'scold'    => 'sad',
            'walk'     => 'walk',
            'meal'     => 'eat',
            'groom'    => 'clean',
            'hospital' => 'sick',
            default    => 'default',
        };
    }
}
