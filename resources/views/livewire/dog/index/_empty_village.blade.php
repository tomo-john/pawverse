<div class="relative flex flex-col items-center gap-3 w-full h-64 p-4
            bg-gradient-to-b from-pink-50 to-pink-100/50 shadow-md hover:shadow-xl
            border border-pink-100 rounded-3xl
            transition-all duration-300"
>
    {{-- 犬小屋 --}}
    <div class="relative">
        <i @class([
            'fa-solid fa-house text-9xl transition-all duration-500',
            'text-gray-300 opacity-40' => !$this->hasName,
            'text-amber-300 opacity-100 animate-pulse' => $this->hasName,
         ])
        ></i>
        {{-- 犬小屋の名札 --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 translate-y-5
                    px-3 py-1 text-xs rounded-full bg-white/90 backdrop-blur border border-pink-100 text-slate-500 shadow whitespace-nowrap">
            {{ $name ? Str::limit($name, 12) : '名無しの家' }}
        </div>
    </div>

    {{-- 犬 --}}
    <div @class([
             'absolute top-0 left-1/2 -translate-x-1/2 translate-y-40 transition-all duration-500',
             'opacity-0 scale-50' => !$this->hasName,
             'opacity-100 scale-100 animate-pulse' => $this->hasName,
         ])
    >
        <i class="fa-solid fa-dog text-4xl"
           style="color: {{ $color }}"
        ></i>
    </div>
</div>
