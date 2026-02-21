<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Dog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'color',
        'size_level',
        'met_at',
        'is_public',
    ];

    protected $casts = [
        'met_at' => 'immutable_date',
        'is_public' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // size_level: 定義
    public const SIZE_CLASSES = [
        1 => 'text-xl',
        2 => 'text-2xl',
        3 => 'text-3xl',
        4 => 'text-4xl',
        5 => 'text-5xl',
        6 => 'text-6xl',
        7 => 'text-7xl',
        8 => 'text-8xl',
        9 => 'text-9xl',
    ];

    // size_level: ラベル用アクセサ
    public function getSizeClassAttribute(): string
    {
        return self::SIZE_CLASSES[$this->size_level] ?? 'text-5xl';
    }

    // is_public: visibility用アクセサ
    public function getPublicVisibilityAttribute(): array
    {
        return [
            'label' => $this->is_public ? '公開中🐶' : '非公開🔒',
            'class' => $this->is_public
                ? 'bg-pink-100 text-pink-700'
                : 'bg-gray-100 text-gray-700'
        ];
    }

    // dog削除時にreal_dogsテーブルに紐づいた写真も削除
    protected static function booted()
    {
        static::deleting(function ($dog) {
            if ($dog->realDog?->photo_path) {
                Storage::disk('public')->delete($dog->realDog->photo_path);
            }
        });
    }

    // RealDogリレーション(1対1)
    public function realDog()
    {
        return $this->hasOne(RealDog::class);
    }

    // DogStatusリレーション(1対1)
    public function status()
    {
        return $this->hasOne(DogStatus::class);
    }
}
