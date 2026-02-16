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

    // 性格の種類定義(ドラクエ3風)
    public const PERSONALITIES = [
        'brave' => 'ゆうかん',
        'gentle' => 'やさしい',
        'lazy' => 'なまけもの',
        'cheerful' => 'ようき',
        'shy' => 'おくびょう',
    ];

    // 性格・アクセサ
    public function getPersonalityLabelAttribute()
    {
        return self::PERSONALITIES[$this->personality] ?? '未登録';
    }

    // 性別・アクセサ
    public function getSexLabelAttribute()
    {
        return [
            'male' => 'オス',
            'female' => 'メス',
        ][$this->sex] ?? '未登録';
    }

    // 年齢・アクセサ (誕生日より算出)
    public function getAgeAttribute(): ?int
    {
        if (! $this->birthday) {
            return null;
        }

        return Carbon::parse($this->birthday)->age;
    }

    // 写真・アクセサ (デフォルト画像)
    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo_path) {
            return asset('storage/' . $this->photo_path);
        }

        return asset('images/dogs/dog_default.jpg');
    }

    // Dogモデルとのリレーション
    public function dog()
    {
        return $this->belongsTo(Dog::class);
    }
}
