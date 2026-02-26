# Userにroleを追加(admin / user)

## マイグレーション

```
php artisan make:migration add_role_to_users_table
```

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
```

## admin helper

Userモデルに自分用メソッドを作成(`isAdmin`):

```php
<?php
public function isAdmin(): bool
{
    return $this->role === 'admin';
}
```

