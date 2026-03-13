# Service責務メモ

## DogStatusService

- ステータス変更
- ステータスログ作成

## DogLevelUpService

- レベルアップ判定
- レベル変更
- レベル差分返す

=> ログは書かない🐶

## DogActionService / RealDogActivityServie

- フロー管理

```
status更新 -> levelup -> ログ -> save
```

=> レベルアップの時のみログ保存

- DogAction: ボタンクリックで発火
- RealDogActivity: 入力フォーム

## DogCooldownService

関連: DogActionService

- クールダウン判定
- 残り時間計算

## DogTimelineService

関連: Show/Timeline

- タイムライン作成用データ作成

