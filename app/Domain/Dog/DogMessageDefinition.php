<?php

namespace App\Domain\Dog;

class DogMessageDefinition
{

    public const DEFAULT     = 'default';
    public const HAPPY_HIGH  = 'happy_high';
    public const HAPPY_LOW   = 'happy_low';
    public const HUNGER_HIGH = 'hunger_high';
    public const STAMINA_LOW = 'stamina_low';

    public const PET = 'pet';
    public const SNACK = 'snack';
    public const SCOLD = 'scold';
    public const WALK = 'walk';
    public const MEAL = 'meal';
    public const GROOM = 'groom';
    public const HOSPITAL = 'hospital';

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
                'うほっうほっ',
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

            self::PET => [
                '嬉しいワン～',
                'きゅぴきゅぴっ',
            ],

            self::SNACK => [
                'むしゃむしゃ',
                'おやつだ！',
            ],

            self::SCOLD => [
                'ぎゃふん',
                'ごめんなさいだワン...',
            ],

            self::WALK => [
                'お散歩楽しい！',
                'ふんふん～♪',
            ],

            self::MEAL => [
                'ごはんありがとうだワン！',
                'おいしいワン～',
            ],

            self::GROOM => [
                'キレイになったワン！',
                'ピカピカッ✨',
            ],

            self::HOSPITAL => [
                'しょんぼり...',
                'ちーん',
            ],

        ];
    }

    public static function rules(): array
    {
        return [
            ['happy', 'danger', 'happy_low'],
            ['hunger', 'danger', 'hunger_high'],
            ['stamina', 'danger', 'stamina_low'],
            ['happy', 'full', 'happy_high'],
        ];
    }

    public static function get(string $type): array
    {
        return self::all()[$type] ?? [];
    }

}
