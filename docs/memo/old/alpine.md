# Alpine.jsの基礎の基礎

## x-dataとは？

Alpine.jsはHTMLに直接くっついた小さなJavaScript。

`x-data`はこのHTMLの中で使う状態(state)と関数を定義する場所。

```html
<div x-data="xxx">
```

この`xxx`はJavaScript式。

中身は

- オブジェクト: `{ ... }`
- 関数呼び出し: `foo()`
- 変数: `bar`

=> 最終的にオブジェクトが返ればOK

```html
<div x-data="{
    name: 'じょん',
    size: 'small',
    bark() {
        console.log('wan!');
    }
}">
```

これはJSでは

```javascript
{
  name: 'じょん',
  size: 'small',
  bark() {...}
}
```

このオブジェクトがその`div`の状態になる。

## Alpineのルール

この中で定義したものは:

- `x-text="name"`
- `x-model="size"`
- `@click=bark()`
- `this.size`(関数内)

として使用できる。

## サンプル

```html
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
    }"
>
```

### データ(state)

`name`, `color`, `size` => フォーム入力とプレビューの共通状態

### メソッド(関数)

`sizeClass()`は、`this.size`を見て対応するTailwindクラスを返す => 表示用ロジック

## このサンプルの問題点

Blade => JSに文字列を直で埋め込んでいる

`0'Connor`みたいなシングルクォートを含んだ文字列が来るとJavaScriptとして壊れる。

`@js()`(Bladeヘルパ)を使用して書き換える。

=> PHP配列を安全なJavaScriptオブジェクトに変換するBladeヘルパ

また、`<div x-data="{...}"`の書き方は即席のAlpineコンポーネント(直書き)状態。

これを関数経由の書き方に変えて、再利用できる設計図とする。

```html
<div
  x-data="dogForm(
    @js([
      'name' => old('name', $dog->name ?? ''),
      'color' => old('color', $dog->color ?? 'gray'),
      'size' => old('size', $dog->size ?? 'medium'),
    ])
  )"
>
```

### 軽く整理

- [PHP / Laravle]: `Form.php` => Bladeに変数渡すだけ
- [Blade]: `x-data="dogForm(@js(...))"` => JSの関数を呼び、戻り値のオブジェクトがx-data
- [JavaScript / Alpine]: `dogForm()` => 状態とロジックの本体

### dogForm()

```javascript
document.addEventListener('alpine:init', () => {
    Alpine.data('dogForm', (initial) => ({
        name: initial.name ?? '',
        color: initial.color ?? 'gray',
        size: initial.size ?? 'medium',

        sizeClass() {
            return {
                small: 'text-4xl',
                medium: 'text-6xl',
                large: 'text-8xl',
            }[this.size]
        },

        colorClass() {
            return {
                white: 'text-white drop-shadow',
                black: 'text-black',
                gray: 'text-gray-500',
                brown: 'text-amber-800',
                gold: 'text-yellow-500',
            }[this.color]
        },
    }))
})
```

=> 今回はこれをいったん`resources/js/sandbox.js`に追記した🐶

