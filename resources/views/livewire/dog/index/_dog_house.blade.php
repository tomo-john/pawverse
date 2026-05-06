<div wire:key="dog-{{ $dog->id }}"
     class="relative flex flex-col items-center justify-end w-hull h-64 p-4
            bg-gradient-to-b from-pink-50 to-pink-100/50 shadow-md hover:shadow-xl
            border border-pink-100 rounded-3xl
            transition-all duration-300 hover:-translate-y-1"
>

    {{-- 地面 --}}
    <div class="absolute bottom-0 left-0 w-full h-16 bg-green-100 rounded-3xl"></div>

    {{-- 犬小屋エリア --}}
    <a href="{{ route('dog.show', $dog) }}"
       class="absolute top-6 flex flex-col items-center group z-10"
    >
        <div class="relative">
            <i class="fa-solid fa-house text-8xl text-amber-300 drop-shadow-md transition group-hover:scale-110"></i>

            <div class="absolute top-0 left-1/2 -translate-x-1/2 translate-y-5
                        px-3 py-1 text-xs rounded-full bg-white/90 backdrop-blur border border-pink-100 text-slate-500 shadow whitespace-nowrap">
                {{ Str::limit($dog->name, 10) }}
            </div>
        </div>

    </a>

    {{-- 犬 --}}
    <div class="relative z-20 flex flex-col items-center">
        <i class="fa-solid fa-dog {{ $dog->size_class }}
                  transition-all duration-300
                  hover:scale-110 hover:-rotate-3"
           style="color: {{ $dog->color }}"></i>
    </div>

</div>
