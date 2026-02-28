# DI(依存性注入)とは？

クラスが必要とするものを自分で作らずに外から渡してもらう仕組み。

## DIない(依存が強い例)

```php
class DogService
{
    public function __construct()
    {
        $this->repo = new DogRepository();
    }
}
```

- DogRepository固定になる
- テストしずらい
- 差し替えできない

## DIあり(依存を外から渡す)

```php
class DogService
{
    public function __construct(DogRepository $repo)
    {
        $this->repo = $repo;
    }
}
```

- 差し替え自由
- テストしやすい
- 保守性UP

## Service Container

LaravelはService ContaiinerがDIを自動でやってくれる。

型を書く => 自動でインスタンス作って渡してくれる

## Controllerでの例

```php
class DogController extends Controller
{
    public function __construct(private DogService $service) {}

    public function index()
    {
        return $this->service->all();
    }
}
```

Laravel内部でやっていること🐶

- DogController作る
- DogService必要
- DogService作る
- 渡す

DogControllerはDogServiceの作り方知らない。ただ使うだけ。

=> 使う側は作り方を知らなくていい

---

## Livewire

Livewireは呼び出し元によってDIの解決方法が違う。

| 呼ばれ方              | DIできる？       | 理由                          |
| --------------------- | ---------------- | ----------------------------- |
| wire:click(メソッド)  | 可能             | Laravelコンテナ経由で呼ばれる |
| mount()               | 不可(引数DI不可) | Livewireが直接呼ぶ            |
| render()              | 不可             | 同上                          |

=> mount()やrender()ではメソッドDIができない🐶泣

なので`boot()`を使う。(`app(DogActionService::class)`みたいなのでもいけるけど今回不採用)

```php
public function boot(DogActionService $service)
{
    $this->service = $service;
}
```

`boot()`はContainer経由で呼ばれるのでDIが可能らしい。

