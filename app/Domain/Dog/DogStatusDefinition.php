<?php

namespace App\Domain\Dog;

class DogStatusDefinition
{

    public const HAPPY   = 'happy';
    public const STAMINA = 'stamina';
    public const HUNGER  = 'hunger';
    public const EXP     = 'exp';
    public const LEVEL   = 'level';

    public static function all(): array
    {
        return [
            self::HAPPY => [
                'icon'  => '😊',
                'color' => 'text-pink-500',
                'min'   => 0,
                'max'   => 500,
                'clamp' => true,
                'bars'  => [
                    'label' => 'Happy',
                    'color' => 'bg-pink-400',
                ],
            ],

            self::STAMINA => [
                'icon'  => '💪',
                'color' => 'text-blue-500',
                'min'   => 0,
                'max'   => 300,
                'clamp' => true,
                'bars'  => [
                    'label' => 'Stamina',
                    'color' => 'bg-green-400',
                ],
            ],

            self::HUNGER => [
                'icon'  => '🍖',
                'color' => 'text-orange-500',
                'min'   => 0,
                'max'   => 100,
                'clamp' => true,
                'bars'  => [
                    'label' => 'Hunger',
                    'color' => 'bg-yellow-400',
                ],
            ],

            self::EXP => [
                'icon' => '⭐',
                'color' => 'text-yellow-500',
                'clamp' => false,
            ],

            self::LEVEL => [
                'clamp' => false,
            ],
        ];
    }

    public static function get($status)
    {
        return self::all()[$status] ?? null;
    }

    public static function min(string $status): int
    {
        return self::all()[$status]['min'] ?? PHP_INT_MIN;
    }

    public static function max(string $status): int
    {
        return self::all()[$status]['max'] ?? PHP_INT_MAX;
    }

    public static function shouldClamp(string $status): bool
    {
        return self::all()[$status]['clamp'] ?? false;
    }

    public static function getBars(): array
    {
        return array_filter(self::all(), fn ($def) => isset($def['bars']));
    }

}
