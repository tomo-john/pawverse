# Architecture Map — Dog System

---

# 1. レイヤー構造

UI Layer
→ Livewire Component

Application Layer
→ Service

Domain Layer
→ Action / Support

Data Layer
→ Model / DB

---

---

# 2. クラス責務一覧

---

## Livewire

### Dog\Show

役割
UI操作の受付・表示データ取得

やっていいこと

* Service呼び出し
* View返却
* validation

やってはいけないこと

* ステータス計算
* DB直接更新ロジック

依存

* DogActionService

---

---

## Service

---

### DogActionService

役割
アクション実行の中核制御

責務

* Action定義取得
* Status更新
* clamp処理
* LevelUp呼び出し
* Log保存

公開メソッド
execute(Dog $dog, string $action)

依存

* DogAction
* DogLevelUpService
* DogActionLog

---

---

### DogLevelUpService

役割
レベルアップ判定・処理

責務

* レベルアップ可否判定
* exp消費
* level加算

公開メソッド
handle(Dog $dog)

依存

* DogLevel

---

---

## Domain定義

---

### DogAction

役割
アクションの定義データ管理

責務

* action定義配列保持
* 指定action返却

公開メソッド
get(string $action)

※ロジックを書かない（重要）

---

---

### DogLevel

役割
レベル計算ルール定義

責務

* 必要exp返却
* レベルアップ判定
* 残りexp計算

公開メソッド
expToNext(int $level)
canLevelUp(int $level, int $exp)
remainingExp(int $level, int $exp)

---

---

## Model

---

### Dog

責務

* relation定義
* 所有者判定

---

### DogStatus

責務

* ステータス保持のみ
* 計算禁止

---

### DogActionLog

責務

* ログ保存のみ

---

---

# 3. 呼び出しフロー

ユーザー操作
↓
Livewire action()
↓
DogActionService::execute()
↓
DogAction::get()
↓
Status更新
↓
DogLevelUpService
↓
DogLevel
↓
DogActionLog保存

---

---

# 4. 依存ルール（超重要）

下方向のみ依存可能

Livewire
→ Service
→ Domain
→ Model

逆方向は禁止

例（禁止）
Model → Service 呼び出し

---

---

# 5. 設計ポリシー

原則：

ロジックは必ずServiceに書く

理由：

* 再利用できる
* テストできる
* UIに依存しない
* API化しても流用できる

---

---

# 6. 設計が崩れた時のチェック表

仕様追加時に確認：

[ ] Serviceを経由しているか
[ ] Modelにロジック書いてないか
[ ] Action定義にロジック混ざってないか
[ ] clamp忘れてないか

---

---

# 7. 将来拡張想定

追加予定クラス：

DogCooldownService
DogConditionService
DogTitleService
DogEmotionService

---

---

# 8. 最重要設計思想

Service = アプリの心臓

ここが壊れると全部壊れる

---

---

# 更新履歴

| 日付         | 内容 |
| ---------- | -- |
| YYYY-MM-DD | 初版 |
