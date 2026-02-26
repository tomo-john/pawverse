# DogPolicy

DogControllerのupdateで`$this->authorize()`を使いたい。

```php
<?php
public function edit(Dog $dog)
{
    $this->authorize('update', $dog);

    $sizes = Dog::sizes();

    return view('dogs.edit', compact('dog', 'sizes'));
}
```

## Step 0: Controller.phpにTraitを追加

Laravel12ではControllerに`authorize()`が最初から入ってないので追加。

`app/Http/Controllers/Controller.php`:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller
{
    use AuthorizesRequests;
}
```

## Step 1: DogPolicyを作る

```bash
php artisan make:policy DogPolicy --model=Dog
```

## Step 2: DogPolicyの中身を書く

`app/Policies/DogPolicy.php`:

```php
<?php

namespace App\Policies;

use App\Models\Dog;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DogPolicy
{
    /**
     * 更新できるか？
     */
    public function update(User $user, Dog $dog): bool
    {
        return $user->id === $dog->user_id;
    }
}
```

