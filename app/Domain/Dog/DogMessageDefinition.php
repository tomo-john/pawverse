<?php

namespace App\Domain\Dog;

class DogMessageDefinition
{

    public const DEFAULT     = 'default';
    public const HAPPY_HIGH  = 'happy_high';
    public const HAPPY_LOW   = 'happy_low';
    public const HUNGER_HIGH = 'hunger_high';
    public const STAMINA_LOW = 'stamina_low';

    public static function all(): array
    {
        return [
            self::DEFAULT => [
                '今日も元気だワン！',
                '一緒に遊ぶワン？',
            ],

            self::HAPPY_HIGH => [
                'すごく楽しいワン！',
                'いつもありがとうだワン！',
            ],

            self::HAPPY_LOW => [
                'くーんくーん',
                '遊んでほしいワン...',
            ],

            self::HUNGER_HIGH => [
                'おなかすいたワン',
                'ごはんまだ？',
            ],

            self::STAMINA_LOW => [
                'ちょっと疲れたワン',
                '今日はのんびりしたいワン',
            ],
        ];
    }

    public static function get(string $type): array
    {
        return self::all()[$type] ?? [];
    }

}
