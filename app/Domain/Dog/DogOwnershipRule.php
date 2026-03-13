<?php

namespace App\Domain\Dog;

use App\Models\Dog;

class DogOwnershipRule
{
    public const MAX_DOGS = 6;

    public static function canAdopt(int $currentDogs): bool
    {
        return $currentDogs < self::MAX_DOGS;
    }

}
