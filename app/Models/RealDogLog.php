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

    // Type定義
    public const TYPE_WALK = 'walk';
    public const TYPE_MEAL = 'meal';
    public const TYPE_GROOM = 'groom';
    public const TYPE_HOSPITAL = 'hospital';

    public const TYPES = [
        self::TYPE_WALK,
        self::TYPE_MEAL,
        self::TYPE_GROOM,
        self::TYPE_HOSPITAL,
    ];

    // Typeラベル用
    public const LABELS = [
        self::TYPE_WALK => '散歩',
        self::TYPE_MEAL => 'ごはん',
        self::TYPE_GROOM => 'トリミング',
        self::TYPE_HOSPITAL => '病院',
    ];

    // ラベル表示用アクセサ
    public function getTypeLabelAttribute(): string
    {
        return self::LABELS[$this->type] ?? $this->type;
    }

    // Dogモデルに属する
    public function dog()
    {
        return $this->belongsTo(Dog::class);
    }
}
