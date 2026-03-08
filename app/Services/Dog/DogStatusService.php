<?php

namespace App\Services\Dog;

use App\Models\Dog;

class DogStatusService
{
    // ステータス反映処理
    public function applyEffects(Dog $dog, array $effects): void
    {
        $status = $dog->status;

        foreach ($effects as $key => $value) {
            if (! isset($status->$key)) {
                continue;
            }

            // exp, levelはclampしない
            if (in_array($key, ['exp', 'level'])) {
                $status->$key += $value;
            } else {
                $status->$key = $this->clamp($status->$key + $value);
            }
        }
    }

    // clamp
    public function clamp(int $value): int
    {
        return max(0, min(100, $value));
    }
}
