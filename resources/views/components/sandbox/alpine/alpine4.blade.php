<div class="p-6 m-6 bg-white rounded-xl shadow border border-gray-100"
     x-data="{ active: false }"
>
    <div class="text-center space-y-4">

        {{-- ワンコのアイコン --}}
        <div class="relative text-5xl text-pink-500">
            <i class="fa-solid fa-dog transition-all duration-500"
               @mouseenter="active = true"
               @mouseleave="active = false"
               :class="active ? 'scale-125 rotate-348' : ''"
            ></i>
            <span x-show="active" class="text-pink-500 text-sm">わん！</span>
        </div>

    </div>
</div>
