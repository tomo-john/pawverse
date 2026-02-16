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
        'is_good_boy',
    ];

    protected $casts = [
        'met_at' => 'immutable_date',
        'is_good_boy' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // size_level
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

    public function getSizeClassAttribute(): string
    {
        return self::SIZE_CLASSES[$this->size_level] ?? 'text-5xl';
    }

    // is_good_boy
    public function getGoodBoyLabelAttribute(): string
    {
        return $this->is_good_boy ? 'Good boy 🐶' : 'Naughty dog 😈';
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

    // RealDogリレーション
    public function realDog()
    {
        return $this->hasOne(RealDog::class);
    }
}
