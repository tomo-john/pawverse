<?php

namespace App\Services\Dog;

use App\Models\DogStatusLog;

class DogTimelineService
{
    // まずは最小のService
    public function getLogs(int $dogId, $limit = 50)
    {
        return DogStatusLog::query()
            ->where('dog_id', $dogId)
            ->with('source')
            ->latest()
            ->limit($limit)
            ->get();
    }
}
