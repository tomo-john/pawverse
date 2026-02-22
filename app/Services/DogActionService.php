<?php

/**
 * DogActionServece.php
 * Dog Status変更処理ロジック
 */

namespace App\Services;

use App\Models\Dog;
use App\Actions\DogAction;
use Illuminate\Support\Facades\DB;

class DogActionService
{
    public function execute(Dog $dog, string $action): void
    {
        DB::transaction(function () use ($dog, $action) {

            $definition = DogAction::get($action);
            $status = $dog->status;

            foreach ($definition['effects'] as $key => $value) {
                $status->$key = $this->clamp($status->$key + $value);
            }

            $status->save();
        });
    }

    private function clamp($value): int
    {
        return max(0, min(100, $value));
    }
}
