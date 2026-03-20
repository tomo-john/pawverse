<?php

namespace App\Domain\Dog;

class DogAnimationDefinition
{
    public const WALK = 'walk';
    public const HAPPY = 'happy';

    public static function all(): array
    {
        return [

            self::WALK => [
                'class' => 'dog-walk',
                'duration' => 5,
            ],

            self::HAPPY => [
                'class' => 'dog-happy',
                'duration' => 3,
            ],
        ];
    }

    public static function get(string $type): array
    {
        return self::all()[$type] ?? [];
    }

}
