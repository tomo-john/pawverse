<div
    x-data="{
        message: '呼び出された犬',
        show: false
    }"
>
    <span x-text="message"></span>

    <i class="fa-solid fa-dog text-pink-500 cursor-pointer"
       x-on:click="message = 'わんわん！🐾', show = !show">
    </i>
    <span x-show="show" x-transition.duration.500ms class="bg-green-500 m-2 p-2 rounded shadow-sm">
        なででくれてありがとう🐶
    </span>
</div>
