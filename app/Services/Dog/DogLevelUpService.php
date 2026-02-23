<?php

/**
 * レベルアップ処理
 */

namespace App\Services\Dog;

use App\Models\Dog;
use App\Support\Dog\DogLevel;

class DogLevelUpService
{
    public function handle(Dog $dog): void
    {
        $status = $dog->status;

        // レベルアップ可能か判定
        if (! DogLevel::canLevelUp($status->level, $status->exp)) {
            return;
        }

        // レベルアップ処理(whileで1レベルずつ判定)
        while (DogLevel::canLevelUp($status->level, $status->exp)) {
            // EXP消費
            $status->exp = DogLevel::remainingExp($status->level, $status->exp);

            // レベルアップ(+1)
            $status->level++;
        }

        // 保存
        $status->save();
    }
}
