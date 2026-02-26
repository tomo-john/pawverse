# Dog System Specification

---

# 1. 概要

## 目的

犬育成システムの仕様を明文化し、機能追加・仕様変更・リファクタ時の基準とする。

---

# 2. ドメインモデル

## Dog

役割：ユーザーが所有する育成対象

Relation:

* hasOne RealDog
* hasOne Status
* hasMany ActionLogs

---

## DogStatus

役割：犬の現在ステータス

Columns:

* level
* exp
* happy
* stamina
* hunger

Rules:

* 数値はすべて 0〜100 に clamp
* dog作成時に自動生成される

---

## DogActionLog

役割：行動履歴記録

Columns:

* dog_id
* action
* payload(json)

Payload構造:

```
{
before: status配列,
after: status配列,
effects: action効果
}
```

---

---

# 3. アクション仕様

定義場所: `App\Actions\Dog\DogAction`

形式:

```
action_name => [
effects => [
happy => +5,
stamina => -10
]
]
```

---

## Action一覧

### walk (散歩)

効果:

* happy +20
* stamina -10
* hunger +10
* exp +10

---

### snack (おやつ)

効果:

* happy +10
* stamina +5
* hunger -5
* exp +1

---

### meal (ごはん)

効果:

* happy +10
* stamina +10
* hunger -20
* exp +5

---

---

# 4. 処理フロー

```
UI
↓
Livewire action()
↓
DogActionService::execute()
↓
DogAction 定義取得
↓
Status更新
↓
LevelUpService
↓
Log保存
```

---

---

# 5. レベルシステム

定義場所: `App\Support\Dog\DogLevel`

ルール:

| Level帯 | 必要EXP |
|---------|---------|
| 1〜10   | 50      |
| 11〜20  | 100     |
| 21〜30  | 150     |
| 31〜    | 200     |

---

レベルアップ条件: exp >= 必要exp

処理: while可能ならレベルアップ

---

---

# 6. ビジネスルール

最重要ルール：

* statusは直接変更禁止
* 必ずDogActionService経由

理由: ログ・制限・演出を一元管理するため

---

---

# 7. 将来拡張ポイント

追加予定:

* 行動クールタイム
* 状態異常
* スキル
* 称号
* 表情変化

---

---

# 8. 禁止事項(設計破壊防止)

以下は禁止:

- ❌ Controllerからstatus直接更新
- ❌ Model内で勝手にステータス変更
- ❌ Serviceを通さない変更

---

---

# 9. 変更履歴

| 日付       | 変更内容 |
|------------|----------|
| 2026-02-26 | 初版     |

