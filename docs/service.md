# Service責務メモ

## DogStatusService

- ステータス変更
- ステータスログ作成

## DogLevelUpService

- レベルアップ判定
- レベル変更

=> ログは書かない🐶

# DogActionService

- フロー管理

```
status更新 -> levelup -> ログ -> save
```

