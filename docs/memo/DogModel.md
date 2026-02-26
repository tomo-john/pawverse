# DogModel

```bash
php artisan make:model Dog -m
```

<details>
<summary>最初のマイグレーションファイル</summary>

```php
<?php
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dogs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('color')->default('#000000'); 
            $table->unsignedTinyInteger('size_level')->default(4);
            $table->date('met_at')->nullable();
            $table->boolean('is_good_boy')->default(true);

            $table->timestamps();
        });
    }
};
```

### user_id

- `foreignId`: 外部キーを指定
- `constrained()`: 本当に存在する`id`しか受け付けない
- `cascadeOnDelete()`: 外部キーが消えたら一緒に削除

### size_level

- `unsignedTinyInteger`: とても小さな整数(0~255)

</details>

<details>
<summary>最初のDogモデル</summary>

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'color',
        'size_level',
        'met_at',
        'is_good_boy',
    ];

    protected $casts = [
        'met_at' => 'date',
        'is_good_boy' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // size_level
    public const SIZE_CLASSES = [
        1 => 'text-xl',
        2 => 'text-2xl',
        3 => 'text-3xl',
        4 => 'text-4xl',
        5 => 'text-5xl',
        6 => 'text-6xl',
        7 => 'text-7xl',
        8 => 'text-8xl',
        9 => 'text-9xl',
    ];

    public function getSizeClassAttribute(): string
    {
        return self::SIZE_CLASSES[$this->size_level] ?? 'text-4xl';
    }

    // is_good_boy
    public function getGoodBoyLabelAttribute(): string
    {
        return $this->is_good_boy ? 'Good boy 🐶' : 'Naughty dog 😈';
    }
}
```

</details>

# リレーション関連

### DogモデルにUserのリレーション

```php
<?php
public function user()
{
  return $this->belongsTo(User::class);
}
```

### UserモデルにDogsのリレーション

```php
<?php
public function dogs()
{
  return $this->hasMany(Dog::class);
}
```

