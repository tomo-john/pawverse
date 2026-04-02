<div class="flex justify-center items-center mt-6">
    <a href="{{ route('sandbox.page', 'index') }}" class="px-3 py-1 text-pink-500">Back</a>
</div>

<div class="p-6 m-6 bg-white rounded-xl shadow border border-gray-100"
     x-data="dog()"
>

    <div class="flex flex-col gap-3">
        <div class="flex justify-center items-center gap-2">

            <i class="fa-solid fa-dog text-pink-500"
               :class="{ 'animate-pulse': walking }"
            ></i>

            <span class="text-sm text-pink-600">Alpine検証用</span>

            <i class="fa-solid fa-dog text-pink-500 hover:text-pink-700 hover:animate-pulse cursor-pointer transition-transform duration-500 linear"
               :style="`transform: translate(${x}px, ${y}px)`"
               @click="walk()"
            ></i>

        </div>
        <span x-show="show"
              @click="stop"
              class="max-w-sm mx-auto text-xs text-white bg-pink-600 hover:bg-pink-700 rounded-lg px-2 py-1 cursor-pointer">stop</span>
    </div>

    <script>
        function dog() {
            return {
                x: 0,
                y: 0,
                timer: null,
                show: false,
                walking: false,
                moves: [],

                init() {
                    this.moves = [
                        () => this.x += 10,
                        () => this.x -= 15,
                        () => this.y += 20,
                        () => this.y -= 25,
                    ];
                },

                walk() {
                    this.show = true;
                    this.walking = true;
                    clearInterval(this.timer);

                    this.timer = setInterval(() => {
                        const i = Math.floor(Math.random() * this.moves.length);
                        this.moves[i]();
                    }, 500);
                },

                stop() {
                    clearInterval(this.timer);
                    this.x = 0;
                    this.y = 0;
                    this.show = false;
                    this.walking = false;
                },
            }
        }
    </script>

</div>
