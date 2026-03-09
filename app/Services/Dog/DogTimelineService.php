<?php

namespace App\Services\Dog;

use App\Models\DogStatusLog;

class DogTimelineService
{
    public function getLogs(int $dogId, $limit = 50)
    {
        return DogStatusLog::query()
            ->where('dog_id', $dogId)
            ->with('source')
            ->latest()
            ->limit($limit)
            ->get();
    }

    public function timeline(int $dogId)
    {
        $logs = $this->getLogs($dogId);

        return $logs
            ->groupBy(fn ($log) => $log->source_type . '-' . $log->source_id)
            ->map(function ($group) {

                $first = $group->first();

                return [
                    'time' => $first->created_at,
                    'source' => $first->source,
                    'effects' => $group->map(fn ($log) => [
                        'status' => $log->status_type,
                        'delta' => $log->delta,
                    ])->values(),
                ];
            })
            ->values();
    }
}
