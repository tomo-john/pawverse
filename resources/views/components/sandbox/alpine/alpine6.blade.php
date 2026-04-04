{{-- マウスクリックで移動  --}}
<div x-data="{
        x: 10,
        y: 10,
        green: false,

        move($event) {
            this.x = $event.offsetX;
            this.y = $event.offsetY;
        },

        reset() {
            this.x = 10;
            this.y = 10;
        },

        changeGreen() {
            this.green = ! this.green;
        },
    }"
>

    <div class="h-96 m-6 rounded-xl shadow border border-gray-700 relative cursor-crosshair"
         :class="{ 'bg-green-200': green, 'bg-white': ! green }"
         @click="move($event)"
         @keydown.window.r="reset()"
         @keydown.window.shift.r="changeGreen()"
    >
        <div class="absolute transition-all duration-1000 ease-in-out"
             :style="`left: ${x}px; top: ${y}px;`"
        >
            <i class="fa-solid fa-dog text-3xl"
                 :class="{ 'text-green-600': green, 'text-black': ! green }"
            ></i>
        </div>
    </div>

</div>
