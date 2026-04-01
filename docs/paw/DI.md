# LiviwireでServiceをDI

| パターン   | 使いどころ |
| ---------- | ---------- |
| mount DI   | 初期化だけ |
| メソッドDI | 単発処理   |
| bootDI     | 使いまわし |

## 統一ルール(?)

- アクション系は`メソッドDI`
- 複数回使うServiceは`bootDI`
- mountでServiceは基本使わない(どうしても初期化で必要なとき)

## mountDI

```php
public function mount(Dog $dog, DogMessageService $service)
{
    $this->authorize('view', $dog);
    $this->dog = $dog;
    $this->showMessage($service);
}
```

特徴:
- 初期化時だけ使う
- その場限りでOK
- プロパティを持たない

## メソッドDI

```php
public function save(RealDogActivityService $service)
{
    $this->validate();

    try {
        $service->execute( ....
```

特徴:
- 呼ばれるたびにDIされる
- スコープが一番安全
- Laravel的に正統派(?)

## bootでDI (プロパティ保持)

```php
protected DogMessageService $messageService;

public function boot(DogMessageService $messageService)
{
    $this->messageService = $messageService;
}
```

特徴:
- コンポーネント内で何度も使える
- Livewire的にはこれがDIの本命(??)

