{{-- Run Dog  --}}
<div x-data="{
        move: '',
        moving: false,
     }"
>

    <div class="h-128 m-6 bg-gray-600 rounded-xl shadow border border-gray-700 relative overflow-hidden flex justify-center items-center">
        <div class="absolute text-center transition-transform duration-100 ease-linear">
            <i class="fa-solid fa-dog text-3xl text-pink-500"
               :class="moving ? 'dog-walk' : ''"
            ></i>
        </div>
    </div>

    <div class="flex gap-3 m-6">
        <button @click="moving = !moving"
                x-text="moving ? 'Stop' : 'Move'"
                class="px-3 py-1 rounded-full text-xs font-bold transition-colors duration-300"
                :class="moving
                    ? 'bg-gray-400 text-white hover:bg-gray-500'
                    : 'bg-pink-100 text-pink-500 hover:bg-pink-300'"
        >
            Move
        </button>
    </div>

</div>
