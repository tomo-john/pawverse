<div wire:key="dog-{{ $dog->id }}"
     class="relative group flex flex-col items-center justify-end w-full h-64 p-4
            bg-gradient-to-b from-pink-50 to-pink-100/50 shadow-md hover:shadow-xl
            border border-pink-100 rounded-3xl
            transition-all duration-300 hover:-translate-y-1"
     x-data="dogHouse()"
>

    {{-- 地面 --}}
    <div class="absolute bottom-0 left-0 w-full h-16 bg-green-100 rounded-3xl"></div>

    {{-- 犬小屋 --}}
    <a href="{{ route('dog.house', $dog) }}"
       class="absolute top-6 flex flex-col items-center group z-10"
       @mouseenter="openMessage('お部屋にいくわん？')"
       @mouseleave="closeMessage()"
    >
        <div class="relative">
            <i class="fa-solid fa-house text-8xl text-amber-300 drop-shadow-md transition group-hover:scale-110"></i>

            <div class="absolute top-0 left-1/2 -translate-x-1/2 translate-y-5
                        px-3 py-1 text-xs rounded-full bg-white/90 backdrop-blur border border-pink-100 text-slate-500 shadow whitespace-nowrap">
                {{ Str::limit($dog->name, 12) }}
            </div>
        </div>

    </a>

    {{-- 犬 --}}
    <div class="relative z-20 flex flex-col items-center w-full">
        <i class="fa-solid fa-dog {{ $dog->size_class }}
                  transition-all duration-500
                  hover:scale-110 hover:-rotate-3"
           :class="isLeft ? '-scale-x-100' : 'scale-x-100'"
           style="color: {{ $dog->color }}"></i>

        {{-- セリフ --}}
        <div x-show="showMessage"
             x-transition.duration.200ms
             class="absolute -top-10 left-1/2 -translate-x-1/2 z-30"
        >
            <span x-text="message" class="text-sm font-bold text-slate-500 bg-white px-2 py-1 rounded-xl shadow whitespace-nowrap"></span>
        </div>
    </div>

    {{-- edit --}}
    <div class="absolute bottom-5 right-8 z-30 opacity-0 group-hover:opacity-100 transition">
        <button wire:click="edit({{ $dog->id }})"
                class="fa-solid fa-bone text-2xl text-amber-500 -rotate-12 cursor-pointer"
                @mouseenter="openMessage('お色直しするわん？')"
                @mouseleave="closeMessage()"
        >
        </button>
    </div>

    {{-- テスト(仮) --}}
    <div class="absolute bottom-15 left-8 z-30 opacity-0 group-hover:opacity-100 transition">
        <a href="{{ route('dog.house', $dog)}}"
                class="fa-solid fa-baseball text-2xl text-sky-500 cursor-pointer"
                @mouseenter="openMessage('遊ぶわん？'); isLeft = true"
                @mouseleave="closeMessage(); isLeft = false"
        >
        </a>
    </div>

    {{-- is_public --}}
    <div class="absolute top-4 left-4 z-30">
        @if ($dog->is_public)
            <i class="fa-regular fa-sun text-2xl text-red-500"
               @mouseenter="openMessage('お外で遊んでるわん'); isLeft = true"
               @mouseleave="closeMessage(); isLeft = false"
            ></i>
        @else
            <i class="fa-regular fa-moon text-2xl text-amber-200"
               @mouseenter="openMessage('お家が一番だわん'); isLeft = true"
               @mouseleave="closeMessage(); isLeft = false"
            ></i>
        @endif
    </div>

    {{-- エサ(装飾) --}}
    <div class="absolute top-24 right-16 z-30 hover:rotate-6 transition">
        <i class="fa-solid fa-bowl-food text-2xl text-stone-500"
           @mouseenter="openMessage('むちゅ')"
           @mouseleave="closeMessage()"
        ></i>
    </div>

    {{-- 仮の削除ボタン(あくまで仮) --}}
    <div class="absolute top-4 right-4 z-30 opacity-0 group-hover:opacity-100 transition">
        <button wire:click="delete({{ $dog->id }})"
                wire:confirm="本当にお別れしますか...？"
                class="fa-solid fa-trash-can text-rose-500 cursor-pointer"
                @mouseenter="openMessage('開発用の削除ボタンだわん')"
                @mouseleave="closeMessage()"
        >
        </button>
    </div>


</div>

<script>
    function dogHouse() {
        return {
            isLeft: false,
            showMessage: false,
            message: '',

            openMessage(message = '') {
                this.message = message;
                this.showMessage = true;
            },

            closeMessage() {
                this.message = '';
                this.showMessage = false;
            },
        }
    }
</script>
