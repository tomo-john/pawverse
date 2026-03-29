{{-- Run Dog  --}}
<div x-data="{
        left: 0,
        moving: true,
        timer: null,

        start() {
            this.moving = true;
            this.timer = setInterval(() => {
                this.left += 5;
                if (this.left > 1000) this.left = -50;
            }, 100);
        },

        stop() {
            this.moving = false;
            clearInterval(this.timer);
            this.timer = null;
        },

        toggle() {
            this.moving ? this.stop() : this.start();
        }
     }"
     x-init="start()"
>

    <div class="h-128 m-6 bg-gray-600 rounded-xl shadow border border-gray-700 relative overflow-hidden">
        <div class="absolute bottom-10 transition-all duration-300 ease-linear"
             :style="`left: ${left}px`"
        >
            <i class="fa-solid fa-dog text-3xl text-pink-500"></i>
        </div>
    </div>

    <div class="flex gap-3 m-6">
        <button @click="toggle()"
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
