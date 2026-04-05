{{-- Random Walk  --}}
<div x-data="{
        x: 0,
        y: 0,
        timer: null,
        isLeft: false,

        init() {
            this.walk();
        },

        walk() {
            this.timer = setInterval(() => {
                distance = this.random();
                this.isLeft = distance < 0 ? true : false;
                this.x += distance;

                distance = this.random();
                this.y += distance;
            }, 1000);
        },

        random() {
            return Math.floor(Math.random() * 101) - 50;
        },
    }"
>

    <div class="h-96 m-6 bg-white rounded-xl shadow border border-gray-700 flex justify-center items-center">
        <div class="relative">
            <div class="absolute transition-all duration-1000 ease-linear" :style="{ left: x + 'px', top: y + 'px'}">
                <i class="fa-solid fa-dog text-sky-300 text-3xl"
                   :class="{ '-scale-x-100': isLeft }"
                ></i>
            </div>
        </div>
    </div>

</div>
