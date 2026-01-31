<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'met_at' => 'date',
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
        return self::SIZE_CLASSES[$this->size_level] ?? 'text-4xl';
    }

    // is_good_boy
    public function getGoodBoyLabelAttribute(): string
    {
        return $this->is_good_boy ? 'Good boy 🐶' : 'Naughty dog 😈';
    }
}
