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
use App\Models\DogActionLog;
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

            // DB変更前の値を取得
            $before = $status->getOriginal();

            // ステータス更新
            foreach ($definition['effects'] as $key => $value) {
                $status->$key = $this->clamp($status->$key + $value);
            }

            // DIされたServiceを使う(レベルアップ処理)
            $this->levelUpService->handle($dog);

            // 保存処理
            $status->save();

            // DB更新後の値を取得
            $after = $status->fresh()->toArray();

            // ログ書き込み
            DogActionLog::create([
                'dog_id' => $dog->id,
                'action' => $action,
                'payload' => [
                    'before' => $before,
                    'after' => $after,
                    'effects' => $definition['effects'],
                ]
            ]);
        });
    }

    // 下限値と上限値を設定
    private function clamp($value): int
    {
        return max(0, min(100, $value));
    }
}
