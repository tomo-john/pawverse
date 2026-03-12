# Dog System

pawverseの犬育成システム🐶

---

# 1. コンセプト

pawverseでは「ゲーム内アクション」、「リアル犬の活動」で犬のステータスが成長する。

---

# 2. ドメインモデル

- RealDog
- DogStatus
- DogAction
- RealDogActivity
- DogStatusLog

---

# 3. ビジネスルール

最重要ルール：

* statusは直接変更禁止
* 必ずService経由

# 4. 禁止事項

以下は禁止:

- Controllerからstatus直接更新
- Model内で勝手にステータス変更
- Serviceを通さない変更

