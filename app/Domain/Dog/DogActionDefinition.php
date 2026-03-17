<?PHP

namespace App\Domain\Dog;

class DogActionDefinition
{
    public const PET = 'pet';
    public const SNACK = 'snack';
    public const SCOLD = 'scold';

    public static function all(): array
    {
        return [
            self::PET => [
                'label' => 'なでる',
                'icon' => 'fa-solid fa-paw',
                'text-color' => 'text-sky-600',
                'button-color' => 'sky',
                'bg' => 'bg-sky-50 border-sky-200',
                'cooldown' => 1,
                'effects' => [
                    'happy' => +5,
                    'stamina' => 0,
                    'hunger' => 0,
                    'exp' => +1,
                ],
            ],

            self::SNACK => [
                'label' => 'おやつ',
                'icon' => 'fa-solid fa-bone',
                'text-color' => 'text-green-600',
                'button-color' => 'green',
                'bg' => 'bg-green-50 border-green-200',
                'cooldown' => 10,
                'effects' => [
                    'happy' => +10,
                    'stamina' => +5,
                    'hunger' => +5,
                    'exp' => +2,
                ],
            ],

            self::SCOLD => [
                'label' => 'しかる',
                'icon' => 'fa-solid fa-shield-dog',
                'text-color' => 'text-red-600',
                'button-color' => 'red',
                'bg' => 'bg-red-50 border-red-200',
                'cooldown' => 30,
                'effects' => [
                    'happy' => -10,
                    'stamina' => 0,
                    'hunger' => 0,
                    'exp' => +30,
                ],
            ],
        ];
    }

    public static function get(string $action): array
    {
        return self::all()[$action] ?? throw new \InvalidArgumentException("Action: $action は見つからないわん！🐶");
    }

    public static function keys(): array
    {
        return array_keys(self::all());
    }

    public static function ui(): array
    {
        return collect(self::all())
            ->map(fn ($action) => [
                'label' => $action['label'],
                'icon'  => $action['icon'],
                'text-color' => $action['text-color'],
                'button-color' => $action['button-color'],
                'bg'    => $action['bg'],
            ])
            ->toArray();
    }

    public static function cooldown(string $action): int
    {
        return self::get($action)['cooldown'];
    }
}
