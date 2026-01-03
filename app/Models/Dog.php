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
     * size
     */
    const SIZE_SMALL  = 'small';
    const SIZE_MEDIUM = 'medium';
    const SIZE_LARGE  = 'large';

    public static function sizes(): array
    {
        return [
            self::SIZE_SMALL  => '小型犬',
            self::SIZE_MEDIUM => '中型犬',
            self::SIZE_LARGE  => '大型犬',
        ];
    }

    /**
     * color
     */
    const COLOR_WHITE = 'white';
    const COLOR_BLACK = 'black';
    const COLOR_GRAY  = 'gray';
    const COLOR_BROWN = 'brown';
    const COLOR_GOLD  = 'gold';

    public static function colors(): array
    {
        return [
            self::COLOR_WHITE => '白',
            self::COLOR_BLACK => '黒',
            self::COLOR_GRAY  => 'グレー',
            self::COLOR_BROWN => '茶色',
            self::COLOR_GOLD  => 'ゴールド',
        ];
    }
}
