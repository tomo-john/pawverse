# DDD(ドメイン駆動設計)とは？🐶

DDD = `Domain Driven Design`

プログラムの都合(DBとか画面)ではなく、現実世界の`犬のルール`を主役にして作ろうって設計の考え方。

## 🐶 Domain = 犬の世界のルール

- 場所: `app/Domain`
- 役割: プログラムを動かく前の純粋なルールを書く場所

Dog関連の定義は全て`app/Domain/Dog`に集約。

ルールは`Domain`、処理の流れは`Service`で統一する(したい🐶)

