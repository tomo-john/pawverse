<?php

namespace App\Services\Dog;

use App\Models\DogStatusLog;
use App\Models\DogAction;
use App\Models\RealDogActivity;
use App\Domain\Dog\DogActionDefinition;
use App\Domain\Dog\RealDogActivityDefinition;

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
                $source = $first->source;

                // Source: DogAction
                if ($source instanceof DogAction) {

                    $def = DogActionDefinition::get($source->action);

                    $label = $def['label'];
                    $icon  = $def['icon'];
                }

                // Source: RealDogActivity
                if ($source instanceof RealDogActivity) {

                    $def = RealDogActivityDefinition::get($source->type);

                    $label = $def['label'];
                    $icon  = $def['icon'];
                }

                $effects = $group->map(function ($log) {

                    $sign = $log->delta > 0 ? '+' : '';

                    return "{$log->status_type} {$sign}{$log->delta}";
                });

                return [
                    'time' => $first->created_at,
                    'label' => $label,
                    'icon' => $icon,
                    'effects' => $effects->values()
                ];
            })
            ->values();
    }
}
