<div class="w-[300px] h-[300px] mx-auto rounded-full
            bg-white/70 backdrop-blur-md
            border border-pink-100 shadow-xl shadow-pink-100/50
            flex flex-col justify-center items-center px-6 py-6
            relative overflow-hidden
            transition-color duration-500 hover:scale-[1.10]"
     style="background-color: {{ $color }}10;"
     x-data="previewDog()"
>

    <div class="text-xs tracking-wide text-slate-400">
        この子はこんな感じだわん
    </div>

    <div class="text-base font-bold text-slate-500 my-2">
        {{ $name ? $name : 'まだ名前がないわん...' }}
    </div>

    <div class="flex flex-1 w-full justify-center items-center transition-all duration-700 ease-out relative"
         :class="show ? 'opacity-100 translate-y-0 scale-100' : 'opacity-0 translate-y-2 scale-95'"
         x-cloak
    >

        <i class="fa-solid fa-dog {{ $this->sizeClass }} drop-shadow-sm transition-all duration-700 hover:-rotate-6"
           style="color: {{ $color }}"></i>

        @if(strlen($name) > 20)
            <div class="absolute -bottom-0 text-[10px] text-orange-400">ちょっと名前長いわん...</div>
        @endif
    </div>

</div>

<script>
    function previewDog() {
        return {
            show: false,

            init() {
                setTimeout(() => {
                    this.show = true;
                }, 1000);
            },
        }
    }
</script>
