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
