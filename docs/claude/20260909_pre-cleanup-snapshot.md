# pawverse リニューアル記録 — 削除前スナップショット

このファイルは、既存の `app/` `resources/views/` 配下を削除する**直前**の状態と、
そこに至るまでの検討内容を記録したもの。Claudeが会話の流れをもとに作成。

関連ドキュメント: [`docs/notes/draft.md`](../notes/draft.md), [`docs/domain-model.md`](../domain-model.md)

---

## 1. リニューアルの経緯

- 単純なCRUDアプリは別のポートフォリオで既に作成済み
- 今回のpawverseでは「CRUDプラスの機能」を持つアプリとして、根本的な設計・コンセプトから見直して0ベースで作り直す方針に
- 「動くコードの再利用」より「学習のために作り直す」ことを優先する（再利用できるものであっても一度消す）

## 2. 変えない軸（コンセプト）

- 犬をテーマにしたアプリであることは変えない
- 「自分だけの相棒犬」を登録して育てるという体験の中心は変えない

## 3. 決まった方針

| 項目 | 方針 |
|---|---|
| リアル犬活動記録（RealDog/RealDogActivity） | 今回は実装しない。ファイルは削除するが、**設計思想（ドメインとして疎結合にしておく）は残す** |
| 犬の飼育数 | 現状は1人1匹スタート。将来の複数飼育も見据え、モデルは `User has many Dog` を前提に設計。ただし上限数を設ける（具体的な数はTBD） |
| ゲーム要素 | 「放置系（時間経過でのステータス変化）」＋「お世話アクション」＋「ミニゲーム」の組み合わせ |
| 外部API連携 | 無理にこじつけない。使うとしても無料のもの限定。優先度は低い |
| 自前API化（Livewire→将来React化） | 今回のスコープでやりたいが、**アプリの機能がある程度形になってから**着手する。今のうちにService層をLivewire専用にせず「呼び出し元を意識しない」設計にしておくことで、後からの移行コストを下げる |
| 学習目的 | Laravel基礎の復習、テスト設計、API連携、スマホ対応。「動くだけでなく自分で説明できること」を重視 |

## 4. ドメインモデルの叩き台（詳細は `docs/domain-model.md` 参照）

- `Dog`（相棒犬本体・不変情報）/ `DogStatus`（可変ステータス・Service経由でのみ更新）/ `DogGrowthEvent`（成長のきっかけを記録するログ）の3層構成を提案
- `DogGrowthEvent.source` に `game_action` / `minigame` / （将来）`real_activity` を持たせることで、RealDog連携を将来復活させる際の拡張ポイントにしている
- ステータス候補: レベル・経験値・Happy・HP・性格（すべて詳細はTBD）

## 5. 未決定事項（TBD）

`docs/domain-model.md` の「4. 未決定事項」と同一。今後 `docs/notes/draft.md` で詰めていく想定。

- personality（性格）の型・値の範囲
- 経験値→レベルの計算式
- happy / hp の減衰ルール
- 複数飼育の上限数
- DogGrowthEvent.type の具体的な種類一覧
- ミニゲームの種類・回数制限の有無

---

## 6. 削除前のファイル構成スナップショット（2026年9月時点）

以降、この構成を一度削除して作り直す。参照用に残しておく。

### app/

```
app/Actions/Fortify/CreateNewUser.php
app/Actions/Fortify/ResetUserPassword.php
app/Concerns/PasswordValidationRules.php
app/Concerns/ProfileValidationRules.php
app/Domain/Dog/DogActionDefinition.php
app/Domain/Dog/DogAnimationDefinition.php
app/Domain/Dog/DogLevelDefinition.php
app/Domain/Dog/DogMessageDefinition.php
app/Domain/Dog/DogOwnershipRule.php
app/Domain/Dog/DogReactionDefinition.php
app/Domain/Dog/DogStatusDefinition.php
app/Domain/Dog/RealDogActivityDefinition.php
app/Http/Controllers/Controller.php
app/Livewire/Actions/Logout.php
app/Livewire/Dog/Create.php
app/Livewire/Dog/House.php
app/Livewire/Dog/House/ActivityForm.php
app/Livewire/Dog/House/CareActions.php
app/Livewire/Dog/House/RealDogCard.php
app/Livewire/Dog/House/StatusPanel.php
app/Livewire/Dog/House/Timeline.php
app/Livewire/Dog/KennelManager.php
app/Livewire/Dog/Village.php
app/Livewire/Dog/World.php
app/Livewire/PublicDog/Index.php
app/Livewire/Settings/Appearance.php
app/Livewire/Settings/DeleteUserForm.php
app/Livewire/Settings/Password.php
app/Livewire/Settings/Profile.php
app/Livewire/Settings/TwoFactor.php
app/Livewire/Settings/TwoFactor/RecoveryCodes.php
app/Models/Dog.php
app/Models/DogAction.php
app/Models/DogStatus.php
app/Models/DogStatusLog.php
app/Models/RealDog.php
app/Models/RealDogActivity.php
app/Models/User.php
app/Policies/DogPolicy.php
app/Providers/AppServiceProvider.php
app/Providers/FortifyServiceProvider.php
app/Providers/VoltServiceProvider.php
app/Services/Dog/DogActionService.php
app/Services/Dog/DogCooldownService.php
app/Services/Dog/DogLevelUpService.php
app/Services/Dog/DogMessageService.php
app/Services/Dog/DogStatusService.php
app/Services/Dog/DogTimelineService.php
app/Services/Dog/RealDogActivityService.php
```

### resources/views/

```
resources/views/components/action-message.blade.php
resources/views/components/app-logo-icon.blade.php
resources/views/components/app-logo.blade.php
resources/views/components/auth-header.blade.php
resources/views/components/auth-session-status.blade.php
resources/views/components/desktop-user-menu.blade.php
resources/views/components/dog/toast.blade.php
resources/views/components/layouts/app.blade.php
resources/views/components/layouts/auth.blade.php
resources/views/components/layouts/base.blade.php
resources/views/components/layouts/guest.blade.php
resources/views/components/layouts/partials/footer.blade.php
resources/views/components/layouts/partials/header.blade.php
resources/views/components/placeholder-pattern.blade.php
resources/views/components/sandbox/alpine/alpine0.blade.php 〜 alpine9.blade.php
resources/views/components/sandbox/dog/walk.blade.php
resources/views/components/sandbox/flex/flex.blade.php
resources/views/components/sandbox/maze/maze.blade.php
resources/views/components/sandbox/walk/walk.blade.php
resources/views/components/settings/layout.blade.php
resources/views/components/⚡dashboard.blade.php
resources/views/flux/icon/book-open-text.blade.php
resources/views/flux/icon/chevrons-up-down.blade.php
resources/views/flux/icon/folder-git-2.blade.php
resources/views/flux/icon/layout-grid.blade.php
resources/views/flux/navlist/group.blade.php
resources/views/layouts/app.blade.php
resources/views/layouts/app/header.blade.php
resources/views/layouts/app/sidebar.blade.php
resources/views/layouts/auth.blade.php
resources/views/layouts/auth/card.blade.php
resources/views/layouts/auth/simple.blade.php
resources/views/layouts/auth/split.blade.php
resources/views/livewire/auth/*.blade.php（confirm-password, forgot-password, login, register, reset-password, two-factor-challenge, verify-email）
resources/views/livewire/dog/create.blade.php
resources/views/livewire/dog/house.blade.php
resources/views/livewire/dog/house/activity-form.blade.php
resources/views/livewire/dog/house/care-actions.blade.php
resources/views/livewire/dog/house/real-dog-card.blade.php
resources/views/livewire/dog/house/status-panel.blade.php
resources/views/livewire/dog/house/timeline.blade.php
resources/views/livewire/dog/kennel-manager/dog_area.blade.php
resources/views/livewire/dog/kennel-manager/dogs.blade.php
resources/views/livewire/dog/kennel-manager/form.blade.php
resources/views/livewire/dog/kennel-manager/index.blade.php
resources/views/livewire/dog/kennel-manager/preview.blade.php
resources/views/livewire/dog/village/dogs.blade.php
resources/views/livewire/dog/village/index.blade.php
resources/views/livewire/dog/world/dog-actor.blade.php
resources/views/livewire/dog/world/index.blade.php
resources/views/livewire/dog/world/no-dog.blade.php
resources/views/livewire/dog/world/with-dog.blade.php
resources/views/livewire/public-dog/index.blade.php
resources/views/livewire/settings/*.blade.php（appearance, delete-user-form, password, profile, two-factor, two-factor/recovery-codes）
resources/views/pages/top.blade.php
resources/views/partials/head.blade.php
resources/views/partials/settings-heading.blade.php
resources/views/sandbox/alpine.blade.php
resources/views/sandbox/field.blade.php
resources/views/sandbox/flex.blade.php
resources/views/sandbox/index.blade.php
resources/views/sandbox/maze.blade.php
resources/views/sandbox/walk.blade.php
resources/views/welcome.blade.php
```

### routes/

```
routes/console.php
routes/settings.php
routes/web.php
```

（ルーティング内容: `/`, `dogs/kennel-manager`, `dogs/world`, `dogs/village`, `dogs/create`, `dogs/{dog}`, `/dashboard`(Volt), `public/dogs`, `sandbox/{page}`）

### 削除候補として会話中に挙がったもの

- `App\Livewire\Dog\World`, `App\Livewire\Dog\KennelManager`（旧検証用）とその配下
- `App\Livewire\PublicDog\Index`（今回のスコープ外）
- `App\Models\RealDog`, `App\Models\RealDogActivity` とその関連Service（設計思想は`DogGrowthEvent`として引き継ぐ）
- `Village` は役割変更のため実質作り直し

※ 実際にどこまで削除するかは本人判断で実行。この記録はあくまで「削除前の状態と、なぜ削除するに至ったかの思想」の保存が目的。

---

## 7. 次のステップ（削除後）

1. 未決定事項（TBD）を `docs/notes/draft.md` で詰める
2. `docs/domain-model.md` を確定させる
3. マイグレーション・モデル設計
4. Service層 → Livewireの順で実装
