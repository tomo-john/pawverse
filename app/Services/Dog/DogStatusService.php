<?php

namespace App\Services\Dog;

use App\Models\Dog;
use App\Domain\Dog\DogStatusDefinition;
use Illuminate\Database\Eloquent\Model;

class DogStatusService
{
    // ステータス反映処理
    public function applyEffects(
        Dog $dog,
        array $effects,
        Model $source,
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

            // ステータス値計算・反映
            $newValue = $status->$key + $value;

            if (DogStatusDefinition::shouldClamp($key)) {
                $newValue = $this->clamp($newValue, $key);
            }

            $status->$key = $newValue;

            // ログ保存
            $this->log(
                dog: $dog,
                source: $source,
                type: $key,
                delta: $value
            );
        }
    }

    // clamp
    public function clamp(int $value, string $key): int
    {
        return max(
            DogStatusDefinition::min($key),
            min(DogStatusDefinition::max($key), $value)
        );
    }

    // ログ保存用メソッド
    public function log(
        Dog $dog,
        Model $source,
        string $type,
        int $delta
    ): void {

        $source->statusLogs()->create([
            'dog_id' => $dog->id,
            'status_type' => $type,
            'delta' => $delta
        ]);
    }

}
