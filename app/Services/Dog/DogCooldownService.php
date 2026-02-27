<?php

/**
 * DogCooldownServece.php
 * クールダウンロジック
 */

namespace App\Services\Dog;

use App\Models\Dog;
use App\Actions\Dog\DogAction;

class DogCooldownService
{
    public function getRemainingSeconds(Dog $dog, string $action): int
    {
        $definition = DogAction::get($action);

        $lastLog = $dog->actionLogs()->where('action', $action)->first();

        if (! $lastLog) {
            return 0;
        }

        $cooldownMinutes = $definition['cooldown'];

        $nextAvailableAt = $lastLog->created_at->addMinutes($cooldownMinutes);

        $remaining = now()->diffInSeconds($nextAvailableAt, false);

        return max(0, $remaining);
    }

    public function canExexute(Dog $dog, string $action): bool
    {
        return $this->getRemainingSeconds($dog, $action) === 0;
    }
}

