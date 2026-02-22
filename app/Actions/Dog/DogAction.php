<?php

/**
 * DogAction.php
 * Action定義クラス
 */

namespace App\Actions\Dog;

class DogAction
{
    public const WALK = 'walk';
    public const SNACK = 'snack';
    public const MEAL = 'meal';

    public static function all(): array
    {
        return [
            self::WALK => [
                'label' => '散歩',
                'cooldown' => 10,
                'effects' => [
                    'happy' => +20,
                    'stamina' => -10,
                    'hunger' => +10,
                    'exp' => +5,
                ],
            ],

            self::SNACK => [
                'label' => 'おやつ',
                'cooldown' => 5,
                'effects' => [
                    'happy' => +10,
                    'stamina' => +5,
                    'hunger' => -5,
                    'exp' => +1,
                ],
            ],

            self::MEAL => [
                'label' => 'ごはん',
                'cooldown' => 30,
                'effects' => [
                    'happy' => +10,
                    'stamina' => +10,
                    'hunger' => -20,
                    'exp' => +5,
                ],
            ],
        ];
    }

    public static function get(string $action): array
    {
        return self::all()[$action] ?? throw new \Exception("Invalid action");
    }
}
