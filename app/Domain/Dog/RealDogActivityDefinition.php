<?PHP

namespace App\Domain\Dog;

class RealDogActivityDefinition
{
    public const WALK = 'walk';
    public const MEAL = 'meal';
    public const GROOM = 'groom';
    public const HOSPITAL = 'hospital';

    public static function all(): array
    {
        return [
            self::WALK => [
                'label' => 'さんぽ',
                'icon' => 'fa-solid fa-dog',
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
                'icon' => 'fa-solid fa-bowl-food',
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
                'icon' => 'fa-solid fa-shower',
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
                'icon' => 'fa-regular fa-hospital',
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

    public static function types(): array
    {
        return array_keys(self::all());
    }

    public static function labels(): array
    {
        return collect(self::all())
            ->mapWithKeys(fn ($def, $key) => [$key => $def['label']])
            ->toArray();
    }

    public static function unitOf(string $type): ?string
    {
        return self::get($type)['unit'] ?? null;
    }

    public static function requiresValue(string $type): bool
    {
        return self::get($type)['requires_value'] ?? false;
    }

    public static function maxValue(string $type): ?int
    {
        return self::get($type)['max_value'] ?? null;
    }

    public static function labelOf(string $type): string
    {
        return self::get($type)['label'] ?? $type;
    }
}
