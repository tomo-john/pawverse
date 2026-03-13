<?php

namespace App\Services\Dog;

use App\Models\Dog;
use App\Domain\Dog\DogLevelDefinition;

class DogLevelUpService
{
    // レベルの差分を返す
    public function handle(Dog $dog): int
    {
        $status = $dog->status;

        $before = $status->level;

        // レベルアップ可能か判定
        if (! DogLevelDefinition::canLevelUp($status->level, $status->exp)) {
            return 0;
        }

        // レベルアップ処理(whileで1レベルずつ判定)
        while (DogLevelDefinition::canLevelUp($status->level, $status->exp)) {
            // EXP消費
            $status->exp = DogLevelDefinition::remainingExp($status->level, $status->exp);

            // レベルアップ(+1)
            $status->level++;
        }

        return $status->level - $before;
    }
}
