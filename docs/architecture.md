# Architecture Map — Dog System

pawverseでは責務分離を目標として以下のレイヤー構造で実装🐶

---

## Layer Structure

```
UI (Blade)
↓
Livewire Component
↓
Service
↓
Domain
↓
Model
```

## 各レイヤーの責務

### Balde

表示のみ担当

禁止:

- ビジネスロジック
- DB操作

### Livewire

UIイベント処理

責務:

- ユーザー入力
- Service呼び出し
- Viewへデータ渡し

### Service

アプリケーションロジック

役割:

- 処理フロー制御
- Domainルール適用
- Model更新

### Domain

ビジネスルール定義

役割:

- ルール定義
- ステータス計算
- 定数管理

### Model

データ保持

責務:

- DBリレーション
- データアクセス

---

## Domain Layer

場所: `app/Domain`

役割: アプリケーションのビジネスルールを定義する

Domainは`ルールの定義`を担当し、実際の処理はServiceレイヤーが行う。

## Service Layer

場所: `app/Services`

役割: アプリケーションの実行処理を担う

Serviceは処理フローの制御を担当し、Domainからの定義取得、Model更新、ロジックの絡む処理を行う。

