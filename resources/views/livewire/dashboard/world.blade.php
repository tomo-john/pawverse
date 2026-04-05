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

    <div class="rounded-xl border p-6 h-128 overflow-hidden flex justify-center items-center" x-ref="field">

        <div class="relative">
            <div class="transition-all duration-1000 linear absolute"
                 :style="{ left: x + 'px', top: y + 'px'}"
            >
                <i class="fa-solid fa-dog text-4xl transition-all duration-500"
                   :class="{ 'text-7xl' : big, 'animate-bounce' : walking, '-scale-x-100': isLeft }"
                ></i>
            </div>
        </div>

    </div>

</div>

<script>
    function dog() {
        console.log('dog関数開始🐶');

        return {
            x: 0,
            y: 0,
            maxX: 0,
            maxY: 0,
            big: false,
            walking: false,
            isLeft: false,
            timer: null,

            init() {
                this.maxX = this.$refs.field.clientWidth / 2;
                this.maxY = this.$refs.field.clientHeight / 2;
                this.walk();
            },

            walk() {
                this.walking = true;
                clearInterval(this.timer);

                this.timer = setInterval(() => {
                    let distance = this.random();
                    this.isLeft = distance < 0 ? true : false;

                    let newX = this.x + distance;
                    if (newX > -this.maxX && newX < this.maxX) {
                        this.x = newX;
                    };

                    distance = this.random();
                    let newY = this.y + distance;
                    if (newY > -this.maxY && newY < this.maxY) {
                        this.y = newY;
                    };

                }, 1000)
            },

            random() {
                return Math.floor(Math.random() * 101) - 50;
            },

            stop() {
                this.walking = false;
                clearInterval(this.timer);
            },

            scaleUp() { this.big = ! this.big },
        }
    }
</script>
