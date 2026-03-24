<div class="w-[300px] h-[300px] mx-auto rounded-full
            border border-gray-200 ring-1 ring-gray-200
            flex flex-col justify-center items-center px-6 py-5
            transition-color duration-500"
     style="background-color: {{ $color }}15;"
>

    <div class="text-xs tracking-wide text-gray-400">
        Dog Preview
    </div>

    <div class="text-sm text-gray-500 my-2">
        {{ $name ? $name : 'no name' }}
    </div>

    <div class="flex flex-1 justify-center items-center">
        <i class="fa-solid fa-dog {{ $this->sizeClass }} drop-shadow-sm transition-all duration-500"
           style="color: {{ $color }}"></i>
        @if(strlen($name) > 20)
            <div class="text-[10px] text-orange-400">ちょっと名前長いわん...</div>
        @endif
    </div>

</div>
