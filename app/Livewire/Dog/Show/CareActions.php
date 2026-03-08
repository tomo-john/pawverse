<?php

namespace App\Livewire\Dog\Show;

use Livewire\Component;
use App\Models\Dog;
use App\Domain\Dog\DogActionDefinition;
use App\Services\Dog\DogActionService;
use App\Services\Dog\DogCooldownService;

class CareActions extends Component
{

    public Dog $dog;
    public array $actions = [];
    public array $cooldowns = [];

    // bootでDI
    protected DogCooldownService $cooldownService;

    public function boot(DogCooldownService $cooldownService)
    {
        $this->cooldownService = $cooldownService;
    }

    // 初期化処理
    public function mount(Dog $dog)
    {
        $this->dog = $dog;
        $this->actions = DogActionDefinition::ui();
        $this->loadCooldowns();
    }

    // Action操作
    public function action(string $type, DogActionService $service)
    {
        $service->execute($this->dog, $type);

        $this->dog->refresh();

        $this->loadCooldowns();

        $this->dispatch('dog-updated');
    }

    // クールダウンタイム取得
    public function loadCooldowns()
    {
        foreach (DogActionDefinition::keys() as $key) {
            $remaining = $this->cooldownService->getRemainingSeconds($this->dog, $key);
            $this->cooldowns[$key] = $remaining;
        }
    }

    // クールダウン判定用
    public function isDisabled(string $action): bool
    {
        return ($this->cooldowns[$action] ?? 0) > 0;
    }

    // クールダウン残り時間フォーマット
    public function cooldownFormatted(string $action): string
    {
        $sec = $this->cooldowns[$action] ?? 0;

        $m = floor($sec / 60);
        $s = $sec % 60;

        return sprintf('%02d:%02d', $m, $s);
    }

    public function render()
    {
        return view('livewire.dog.show.care-actions');
    }
}
