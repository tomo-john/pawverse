# Dogの最小モデルを作る

```
php artisan make:model Dog -mcr
```

- migration
- model
- controller
- resource

マイグレーションファイル(最初は最小限):

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dogs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('name');
            $table->string('color');
            $table->string('size');
            $table->boolean('is_public')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dogs');
    }
};
```

Dogモデルも最小限:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    protected $fillable = [
        'name',
        'color',
        'size',
        'is_public',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

