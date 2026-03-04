<?PHP

namespace App\Domain\Dog;

class RealDogLogDefinition
{
    public const WALK = 'walk';
    public const MEAL = 'meal';
    public const GROOM = 'groom';
    public const HOSPITAL = 'hospital';

    public static function all(): array
    {
        return [
            self::WALK => [
                'label' => '散歩',
                'unit' => 'minutes',
                'type' => 'per_unit',
                'requires_value' => true,
                'max_value' => 360,
                'effects_per_unit' => [ // 1分あたり
                    'happy' => 1,
                    'stamina' => -1,
                    'hunger' => 1,
                    'exp' => +1,
                ],
            ],

            self::MEAL => [
                'label' => 'ごはん',
                'unit' => 'grams',
                'type' => 'per_unit',
                'requires_value' => true,
                'max_value' => 1000,
                'effects_per_unit' => [ // 1gramあたり
                    'happy' => 0.1,
                    'stamina' => +0.5,
                    'hunger' => -0.5,
                    'exp' => +0.1,
                ],
            ],

            self::GROOM => [ // 固定値
                'label' => 'トリミング',
                'type' => 'fixed',
                'requires_value' => false,
                'effects' => [
                    'happy' => +20,
                    'stamina' => 0,
                    'hunger' => -10,
                    'exp' => +20,
                ],
            ],

            self::HOSPITAL => [ // 固定値
                'label' => '病院',
                'type' => 'fixed',
                'requires_value' => false,
                'effects' => [
                    'happy' => -100,
                    'stamina' => -50,
                    'hunger' => 0,
                    'exp' => +100,
                ],
            ],
        ];
    }

    public static function get(string $action): array
    {
        return self::all()[$action] ?? throw new \InvalidArgumentException("Action: $action は見つからないわん！🐶");
    }
}
