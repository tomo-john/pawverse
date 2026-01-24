<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dog extends Model
{
    use HasFactory;

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
    const SIZE_1 = 1;
    const SIZE_2 = 2;
    const SIZE_3 = 3;
    const SIZE_4 = 4;
    const SIZE_5 = 5;
    const SIZE_6 = 6;
    const SIZE_7 = 7;
    const SIZE_8 = 8;
    const SIZE_9 = 9;

    public static function sizes(): array
    {
        return [
            self::SIZE_1 => 'XS',
            self::SIZE_2 => 'S',
            self::SIZE_3 => 'M',
            self::SIZE_4 => 'L',
            self::SIZE_5 => 'XL',
            self::SIZE_6 => 'XXL',
            self::SIZE_7 => 'Monster',
            self::SIZE_8 => 'Legend',
            self::SIZE_9 => 'Godzilla',
        ];
    }

    /**
     * color
     */
    const COLOR_WHITE  = 'white';
    const COLOR_BLACK  = 'black';
    const COLOR_GRAY   = 'gray';
    const COLOR_BROWN  = 'brown';
    const COLOR_GOLD   = 'gold';
    const COLOR_RED    = 'red';
    const COLOR_BLUE   = 'blue';
    const COLOR_GREEN  = 'green';
    const COLOR_PINK   = 'pink';
    const COLOR_VIOLET = 'violet';

    public static function colors(): array
    {
        return [
            self::COLOR_WHITE  => '白',
            self::COLOR_BLACK  => '黒',
            self::COLOR_GRAY   => 'グレー',
            self::COLOR_BROWN  => '茶色',
            self::COLOR_GOLD   => 'ゴールド',
            self::COLOR_RED    => 'レッド',
            self::COLOR_BLUE   => 'ブルー',
            self::COLOR_GREEN  => 'グリーン',
            self::COLOR_PINK   => 'ピンク',
            self::COLOR_VIOLET => 'バイオレット',
        ];
    }
}
