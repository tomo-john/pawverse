<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class RealDog extends Model
{
    protected $fillable = [
        'dog_id',
        'breed',
        'sex',
        'personality',
        'birthday',
        'photo_path'
    ];

    protected $casts = [
        'birthday' => 'date',
    ];

    public const PERSONALITIES = [
        'brave' => 'ゆうかん',
        'gentle' => 'やさしい',
        'lazy' => 'なまけもの',
        'cheerful' => 'ようき',
        'shy' => 'おくびょう',
    ];

    public function getPersonalityLabelAttribute()
    {
        return self::PERSONALITIES[$this->personality] ?? '未登録';
    }

    public function getSexLabelAttribute()
    {
        return [
            'male' => 'オス',
            'female' => 'メス',
        ][$this->sex] ?? '未登録';
    }

    public function getAgeAttribute(): ?int
    {
        if (! $this->birthday) {
            return null;
        }

        return Carbon::parse($this->birthday)->age;
    }

    public function dog()
    {
        return $this->belongsTo(Dog::class);
    }
}
