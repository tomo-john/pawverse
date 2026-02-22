<?php

/**
 * レベルアップ経験値テーブル定義
 */

namespace App\Support\Dog;

class DogLevel
{
    /**
     * 次のレベルまでに必要なEXPを返す
     */
    public static function expToNext(int $level): int
    {
        return match (true) {
            $level <= 10 => 50,
            $level <= 20 => 100,
            $level <= 30 => 150,
            default => 200,
        };
    }

    /**
     * レベルアップ可能か判定
     */
    public static function canLevelUp(int $level, int $exp): bool
    {
        return $exp >= self::expToNext($level);
    }

    /**
     * レベルアップ後の残りEXP計算
     */
    public static function remainingExp(int $level, int $exp): int
    {
        return $exp - self::expToNext($level);
    }
}
