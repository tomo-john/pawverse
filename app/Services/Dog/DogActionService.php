<?php

namespace App\Services\Dog;

use App\Models\Dog;
use App\Models\DogAction;
use App\Domain\Dog\DogActionDefinition;
use App\Services\Dog\DogLevelUpService;
use App\Services\Dog\DogCooldownService;
use App\Services\Dog\DogStatusService;
use Illuminate\Support\Facades\DB;

class DogActionService
{
    // コンストラクタで受け取る
    public function __construct(
        private DogLevelUpService $levelUpService,
        private DogCooldownService $cooldownService,
        private DogStatusService $statusService
    ) {}

    public function execute(Dog $dog, string $action): void
    {
        // クールダウンチェック (Service)
        if (! $this->cooldownService->canExecute($dog, $action)) {
            $remaining = $this->cooldownService->getRemainingSeconds($dog, $action);
            throw new \RuntimeException("まだ実行できません🐶(残り: {$remaining} 秒)");
        }

        // トランザクション
        DB::transaction(function () use ($dog, $action) {

            // アクションの定義を取得
            $definition = DogActionDefinition::get($action);

            // ステータス更新 (Service)
            $this->statusService->applyEffects($dog, $definition['effects']);

            // レベルアップ処理 (Service)
            $this->levelUpService->handle($dog);

            // 保存処理
            $dog->status->save();

            // 保存
            $dog->actions()->create([
                'action' => $action,
            ]);
        });
    }
}
