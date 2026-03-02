<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RealDogLog extends Model
{
    protected $fillable = [
        'dog_id',
        'type',
        'value',
        'unit',
        'memo',
        'logged_at',
    ];

    protected $casts = [
        'logged_at' => 'datetime',
    ];

    public const DEFINITIONS = [
        'walk' => [
            'label' => '散歩',
            'unit' => 'minutes',
        ],
        'meal' => [
            'label' => 'ごはん',
            'unit' => 'grams'
        ],
        'groom' => [
            'label' => 'トリミング',
            'unit' => null,
        ],
        'hospital' => [
            'label' => '病院',
            'unit' => null,
        ],
    ];

    // 全タイプ一覧
    public static function types(): array
    {
        return array_keys(self::DEFINITIONS);
    }

    // レベル一覧(select用)
    public static function labels(): array
    {
        return collect(self::DEFINITIONS)
            ->mapWithKeys(fn ($def, $key) => [$key => $def['label']])
            ->toArray();
    }

    // unit取得
    public static function unitOf(string $type): ?string
    {
        return self::DEFINITIONS[$type]['unit'] ?? null;
    }


    // ラベル表示用アクセサ
    public function getTypeLabelAttribute(): string
    {
        return self::DEFINITIONS[$this->type]['label'] ?? $this->type;
    }

    // Dogモデルに属する
    public function dog()
    {
        return $this->belongsTo(Dog::class);
    }
}
