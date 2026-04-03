<div class="flex h-full w-full flex-col gap-6"
     x-data="dog()"
     @keydown.window.b="scaleUp()"
>

    {{-- Dog World --}}
    <div class="flex items-center gap-3 text-sm text-gray-400">
        <i class="fa-solid fa-dog"></i>
        <span x-text="`座標: (${x}, ${y})`"></span>
    </div>

    <div>
        <button class="bg-pink-400 hover:bg-pink-500 rounded-lg px-2 py-1"
                @click="walking ? stop() : walk()"
                x-text="walking ? 'STOP' : 'WALK'"
        >
        </button>
    </div>

    <div class="rounded-xl border p-6 h-128 overflow-hidden">

        <div class="transition-transform duration-200 linear"
             :style="`transform: translate(${x}px, ${y}px)`"
        >
            <i class="fa-solid fa-dog text-4xl transition-all duration-500"
               :class="{ 'text-7xl' : big, 'animate-bounce' : walking }"
            ></i>
        </div>

    </div>

</div>

<script>
    function dog() {
        console.log('dog関数開始🐶');

        return {
            x: 0,
            y: 0,
            big: false,
            walking: false,
            timer: null,

            init() {
                this.walk();
            },

            scaleUp() { this.big = ! this.big },

            walk() {
                this.walking = true;
                clearInterval(this.timer);

                this.timer = setInterval(() => {
                    this.x += 1;
                }, 100)
            },

            stop() {
                this.walking = false;
                clearInterval(this.timer);
            },
        }
    }
</script>
