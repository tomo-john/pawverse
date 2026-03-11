<?php

namespace App\Domain\Dog;

class DogStatusDefinition
{

    public const HAPPY   = 'happy';
    public const STAMINA = 'stamina';
    public const HUNGER  = 'hunger';
    public const EXP     = 'exp';

    public static function all(): array
    {
        return [
            self::HAPPY => [
                'icon' => '😊',
                'color' => 'text-pink-500'
            ],

            self::STAMINA => [
                'icon' => '💪',
                'color' => 'text-blue-500'
            ],

            self::HUNGER => [
                'icon' => '🍖',
                'color' => 'text-orange-500'
            ],

            self::EXP => [
                'icon' => '⭐',
                'color' => 'text-yellow-500'
            ],
        ];
    }

    public static function get($status)
    {
        return self::all()[$status] ?? null;
    }
}
