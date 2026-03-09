<?php

namespace App\Services\Dog;

use App\Models\Dog;
use Illuminate\Database\Eloquent\Model;

class DogStatusService
{
    // ステータス反映処理
    public function applyEffects(
        Dog $dog,
        array $effects,
        Model $source,
        ?string $reason = null
    ): void
    {
        $status = $dog->status;

        foreach ($effects as $key => $value) {

            if ($value === 0) {
                continue;
            }

            if (! isset($status->$key)) {
                continue;
            }

            // ステータス変更(exp, levelはclampしない)
            if (in_array($key, ['exp', 'level'])) {
                $status->$key += $value;
            } else {
                $status->$key = $this->clamp($status->$key + $value);
            }

            // ログ保存
            $source->statusLogs()->create([
                'dog_id' => $dog->id,
                'status_type' => $key,
                'delta' => $value,
                'reason' => $reason,
            ]);
        }
    }

    // clamp
    public function clamp(int $value): int
    {
        return max(0, min(100, $value));
    }
}
