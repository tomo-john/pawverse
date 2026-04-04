{{-- マウスクリックで移動  --}}
<div x-data="{
        x: 10,
        y: 10,

        move($event) {
            this.x = $event.offsetX;
            this.y = $event.offsetY;
        },
    }"
>

    <div class="h-96 m-6 bg-white rounded-xl shadow border border-gray-700 relative cursor-crosshair"
         @click="move($event)"
    >
        <div class="absolute transition-all duration-1000 ease-in-out"
             :style="`left: ${x}px; top: ${y}px;`"
        >
            <i class="fa-solid fa-dog text-3xl text-pink-500"></i>
        </div>
    </div>

</div>
