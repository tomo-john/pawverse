# このapp.jsは何をしているのか？

```javascript
import './bootstrap';
import './sandbox';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
```

## import './bootstrap';

Laravelの初期装備

- axios
- csrf
- Echo

## import './sandbox';

テスト用で使用している自作JS

## import Alpine form 'alpinejs';

Alpine本体を読み込む

## window.Alpine = Alpine;

グローバルに公開

- DevToolsで`Alpine`を触れる
- 他のJSファイルから参照可能

## Alpine.start();

起動スイッチ

DOMを見てx-data, x-on, x-bindを探してAlpineを有効化せよ🐶

