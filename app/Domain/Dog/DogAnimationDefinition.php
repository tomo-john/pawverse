<?php

namespace App\Domain\Dog;

class DogAnimationDefinition
{
    public const HAPPY = 'happy';
    public const EAT = 'eat';
    public const WALK = 'walk';
    public const SAD = 'sad';
    public const CLEAN = 'clean';
    public const SICK = 'sick';

    public static function all(): array
    {
        return [
            self::HAPPY => [
                'class' => 'dog-happy',
                'duration' => 10,
            ],
            self::EAT => [
                'class' => 'dog-eat',
                'duration' => 5,
            ],
            self::WALK => [
                'class' => 'dog-walk',
                'duration' => 5,
            ],
            self::SAD => [
                'class' => 'dog-sad',
                'duration' => 5,
            ],
            self::CLEAN => [
                'class' => 'dog-clean',
                'duration' => 5,
            ],
            self::SICK => [
                'class' => 'dog-sick',
                'duration' => 5,
            ],
        ];
    }

    public static function get(string $reaction): array
    {
        return self::all()[$reaction] ?? [
            'class' => 'dog-default',
            'duration' => 2,
        ];
    }
}
