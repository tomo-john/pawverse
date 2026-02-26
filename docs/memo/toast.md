# トースト機能サンプル

- トースト用コンポーネント作成(Alpine.js)
- PHP側: `dispatch`で信号を送る
- Blade側: その信号を受け取ってコンポーネント呼び出し

## dispath

Livewireの標準的な機能。

ある場所から別の場所へメッセージ(イベント)を飛ばすための機能。

今回はPHPからAlpine側へメッセージを送る。

- PHP側

  ```php
  <?php
  // 'notify' という名前の放送を、データ(message)と一緒に飛ばす
  $this->dispatch('notify', message: '保存完了');
  ```

- Alpine側

  ```blade
  <div x-on:notify.window="alert($event.detail.message)"></div>
  ```

  `$event.detail`の中にPHPから送ったデータが入っている。

## PHP側

```php
<?php
$this->dispatch('notify',
    message: $this->editingId ? '更新しました' : '登録しました',
    variant: 'success'
);
```

## トースト用コンポーネント(Alpine.js)

<details>
<summary>`resource/views/components/dog/toast.blade.php`</summary>

```blade
<div
    x-data="{
        show: false,
        message: '',
        variant: 'success'
    }"

    {{-- イベントをキャッチ --}}
    x-on:notify.window="
        message = $event.detail.message;
        variant = $event.detail.variant || 'success';
        show = true;
        setTimeout(() => show = false, 3000);
    "

    {{-- 表示用アニメーション --}}
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-2"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"

    {{-- トーストの見た目 --}}
    class="fixed bottom-5 right-5 z-50 px-6 py-3 rounded-xl shadow-2xl text-white font-bold flex items-center gap-2"
    :class="{
        'bg-green-500': variant === 'success',
        'bg-red-500': variant === 'danger',
        'bg-blue-500': variant === 'info'
    }"
    style="display: none;"
>
    <i class="fa-solid fa-bell"></i>
    <span x-text="message"></span>
</div>

</details>
