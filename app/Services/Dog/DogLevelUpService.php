<?php

namespace App\Services\Dog;

use App\Models\Dog;
use App\Domain\Dog\DogLevelDefinition;

class DogLevelUpService
{
    public function handle(Dog $dog): void
    {
        $status = $dog->status;

        // レベルアップ可能か判定
        if (! DogLevelDefinition::canLevelUp($status->level, $status->exp)) {
            return;
        }

        // レベルアップ処理(whileで1レベルずつ判定)
        while (DogLevelDefinition::canLevelUp($status->level, $status->exp)) {
            // EXP消費
            $status->exp = DogLevelDefinition::remainingExp($status->level, $status->exp);

            // レベルアップ(+1)
            $status->level++;
        }
    }
}
