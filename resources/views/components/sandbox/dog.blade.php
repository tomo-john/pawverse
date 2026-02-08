<div
    x-data="{
        message: '呼び出された犬'
    }"
>
    <span x-text="message"></span>

    <i class="fa-solid fa-dog text-pink-500 cursor-pointer"
       x-on:click="message = 'わんわん！🐾'">
    </i>
</div>
