# Blade Component

現在は`create`, `edit`のAlpinの`x-data`を直書き、`@include`でプレビュー表示とフォーム画面を読み込んでる。

こんな感じ:

```blade
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            犬を編集する 🐶
        </h2>
    </x-slot>

    <div x-data="{
            name: '{{ old('name', $dog->name ?? '') }}',
            color: '{{ old('color', $dog->color ?? 'gray') }}',
            size: '{{ old('size', $dog->size ?? 'medium') }}',
            sizeClass() {
                return {
                    small: 'text-4xl',
                    medium: 'text-6xl',
                    large: 'text-8xl'
                }[this.size]
            },
            colorClass() {
                return {
                    white: 'text-white drop-shadow',
                    black: 'text-black',
                    gray: 'text-gray-500',
                    brown: 'text-amber-800',
                    gold: 'text-yellow-500'
                }[this.color]
            }
    }">
        <!-- プレビューエリア -->
        @include('dogs._preview')

        <!-- 登録フォーム -->
        @include('dogs._form', [
            'action' => route('dogs.update', $dog),
            'method' => 'PUT',
            'dog' => $dog,
            'submitText' => '更新'
        ])

    <div class="max-w-2xl mx-auto text-center text-gray-500">
        <a href="{{ route('dogs.index') }}">
            <i class="fa-solid fa-backward"></i>
            一覧へ戻る
            <i class="fa-solid fa-dog ml-1 -scale-x-100"></i>
        </a>
    </div>
</x-app-layout>
```

これを`<x-dog.form ... />`で読み込む形に変更する。

## component作成

```bash
php artisan make:component Dog/Form
```

以下のファイルが作成される:

- `app/View/Components/Dog/Form.php`
- `resources/views/components/dog/form.blade.php`

## Components/Dog/Form.phpは何者？

`include`の進化版。

`include`の場合:

```blade
@include('dogs._from', [
    'dog' => $dog,
    'colors' => $colors,
    ...
])
```

- 部品を読み込み
- 変数を配列で渡す
- Bladeの世界だけで完結

`Blade Component`の場合:

```blade
<x-dog.form :dog="$dog" />
```

- HTMLタグっぽく書ける
- PHPクラスが裏で動いている
- 変数の受け渡しが明示的

| 方法           | 正体                      |
|----------------|---------------------------|
| `@include`     | ただのテンプレート        |
| `<x-dog.form>` | PHPクラス付きテンプレート |

## Componentクラス(Form.php)

```php
<?php
class Form extends Component
{
    public $dog;

    public function __construct($dog)
    {
        $this->dog = $dog;
    }

    public function render()
    {
        return view('components.dog.form');
    }
}
```

この場合、このcomponentは、dogというデータを受け取って`components/dog/form.blade.php`を表示する。

=> データの受け渡しだけで、ロジックが一切入っていない

### public $dog; の意味

Bladeから使える変数になる。

`{{ $dog->name }}`がcomponent内で使えるようになる。

### コロンの正体

Bladeのルール:

| 書き方        | 意味           |
|---------------|----------------|
| `dog="hoge"`  | 文字列`"hoge"` |
| `:dog="$dog"` | PHP変数`$dog`  |

## 処理の流れ

- 1: `<x-dog.form ... />`を`create`, `edit`のbladeへ書く
- 2: `App\View\Components\Dog\Form.php`が呼ばれる
- 3: `render()`で`components/form.blade.php`が表示される
- 4: その中に`Alpine` + `preview` + `form`を書く

=> `create`, `edit`からは`@include`が消える

