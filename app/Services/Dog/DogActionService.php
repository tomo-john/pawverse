<?php

/**
 * DogActionServece.php
 * Dog Status変更処理ロジック
 * レベルアップ処理呼び出し
 */

namespace App\Services\Dog;

use App\Models\Dog;
use App\Actions\Dog\DogAction;
use App\Services\Dog\DogLevelUpService;
use Illuminate\Support\Facades\DB;

class DogActionService
{
    // コンストラクタで受け取る
    public function __construct(
        private DogLevelUpService $levelUpService
    ) {}

    public function execute(Dog $dog, string $action): void
    {
        // トランザクション
        DB::transaction(function () use ($dog, $action) {

            // DogAction.phpから指定したアクションの定義を取得
            $definition = DogAction::get($action);
            $status = $dog->status;

            foreach ($definition['effects'] as $key => $value) {
                $status->$key = $this->clamp($status->$key + $value);
            }

            // DIされたServiceを使う
            $this->levelUpService->handle($dog);

            // 最後に保存
            $status->save();
        });
    }

    // 下限値と上限値を設定
    private function clamp($value): int
    {
        return max(0, min(100, $value));
    }
}
