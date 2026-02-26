# Userモデル

ログイン中の人(飼い主)そのもの🐶

Laravelでは`auth()->user()`が返してくるこの正体 = `User`クラスのインスタンス。

=> Userモデルはアプリ世界における人間キャラの設計図

`app/Models/User.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
```

```php
<?php
class User extends Authenticatable
```

`Authenticatable`を継承することによってログイン機能が使用できる。

- ログイン/ログアウト
- パスワード認証
- `auth()`で取得可能

```php
<?php
use HasFactory, Notifiable;
```

- HasFactory: テストやダミーデータ用
- Notifiable: 通知を送れる能力(メール通知・Slack通知など)

```php
<?php
protected $fillable = [
    'name',
    'email',
    'password',
];
```

`$fillable`: まとめて触っていい項目(一気に代入していいカラム一覧)

これは他のモデルでも同じ書き方をする。

```php
<?php
protected $hidden = [
    'password',
    'remember_token',
];
```

`$hidden`: 外に見せない項目(見せちゃダメリスト)

JSON化されたとき、`return auth()->user();`のとき`password`が絶対に出ない。

```php
<?php
protected function casts(): array
{
    return [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
```

`casts()`: 自動変換マシーン

`email_verified_at => datetime`:

- DBでは文字列
- PHPではCarbon(日付オブジェクト)

`password => hashed`:

- 自動で`bcrypt`される
- `Hash::make(...)`を書かなくていい

## sizeをenumっぽく

```php
<?php
const SIZE_SMALL  = 'small';
const SIZE_MEDIUM = 'medium';
const SIZE_LARGE  = 'large';

public static function sizes(): array
{
    return [
        self::SIZE_SMALL  => '小型',
        self::SIZE_MEDIUM => '中型',
        self::SIZE_LARGE  => '大型',
    ];
}
```

