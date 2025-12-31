<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    /**
     * マスアサインメント(一括代入)を許可
     */
    protected $fillable = [
        'name',
        'color',
        'size',
        'is_public',
        'user_id'
    ];

    /**
     * Userに属する
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * sizeをenumっぽく
     */
    const SIZE_SMALL  = 'small';
    const SIZE_MEDIUM = 'medium';
    const SIZE_LARGE  = 'large';

    public static function sizes(): array
    {
        return [
            self::SIZE_SMALL  => '小型',
            self::SIZE_MEDIUM => '中型',
            self::SIZE_LARGE  => '大型',
        ];
    }
}
