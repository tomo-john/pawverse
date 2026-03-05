<?php

namespace App\Services\Dog;

use App\Models\Dog;
use App\Models\RealDogLog;
use App\Domain\Dog\RealDogLogDefinition;
use App\Services\Dog\DogLevelUpService;
use App\Services\Dog\DogStatusService;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RealDogLogService
{
    public function __construct(
        private DogLevelUpService $levelUpService,
        private DogStatusService $statusService
    ) {}

    public function execute(
        Dog $dog,
        string $action,
        ?int $value = null,
        ?string $memo = null,
        Carbon $loggedAt
    ): void
    {
        // 定義取得
        $definition = RealDogLogDefinition::get($action);

        // バリデーション
        $this->validate($dog, $action, $value, $definition);

        // effects計算
        $effects = $this->calculateEffects($definition, $value);

        // トランザクション
        DB::transaction(function () use ($dog, $action, $value, $memo, $loggedAt, $definition,$effects) {

            // ステータス更新 (Service) ** 計算済みのeffectsを渡す **
            $this->statusService->applyEffects($dog, $effects);

            // レベルアップ処理 (Service)
            $this->levelUpService->handle($dog);

            // ステータス保存
            $dog->status->save();

            // ログ保存処理
            RealDogLog::create([
                'dog_id' => $dog->id,
                'type' => $action,
                'value' => $value,
                'unit' => $definition['unit'] ?? null,
                'memo' => $memo,
                'logged_at' => $loggedAt,
            ]);

        });

    }

    // バリデーション
    private function validate($dog, $action, $value, $definition): void
    {
        // RealDog登録済みチェック
        if (! $dog->realDog) {
            throw new \DomainException('RealDogが存在しません🐶');
        }

        // requires_valueチェック
        if ($definition['requires_value']) {

            if ($value === null) {
                throw new \InvalidArgumentException("Action: $action には値が必要です🐶");
            }

            if ($value <= 0) {
                throw new \InvalidArgumentException("Action: $action は0より大きい値を入力してね🐶");
            }

            if (isset($definition['max_value']) && $value > $definition['max_value']) {
                throw new \InvalidArgumentException("Action: $action の値が大きすぎます🐶");
            }
        }

        if (! $definition['requires_value'] && $value !== null) {
            throw new \InvalidArgumentException("Action: $action には値が不要です🐶");
        }

        // ログ入力の制限チェック

        // 異常値の入力チェック
    }

    // ステータス計算(effects)
    private function calculateEffects($definition, $value): array
    {
        if ($definition['type'] === 'fixed') {
            return $definition['effects'];
        }

        // per_unit
        $effects = [];

        foreach ($definition['effects_per_unit'] as $key => $effectPerUnit) {
            $effects[$key] = (int) round($effectPerUnit * $value);
        }

        return $effects;
    }
}
