# home

`/`で最初にアクセスするページ。

将来的にロジックを持たせたいので、単一ビュー画面でなく、Controllerを持たせる。

```php
<?php
// ルーティング
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
```

```bash
# コントローラ作成
artisan make:controller HomeController
```

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
}
```

## ログイン後のリダイレクト先の変更

`app/Http/Controllers/Auth/AuthenticatedSessionController.php`:

```php
<?php
public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();

    $request->session()->regenerate();

    return redirect()->intended(route('dogs.index'));
}
```

=> `return redirect()->intended(route('dashboard', absolute: false));`の箇所を修正(`dogs.index`)

