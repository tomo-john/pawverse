{{-- Random Walk  --}}
<div x-data="{
        x: 0,
        y: 0,
        maxX: 0,
        maxY: 0,
        timer: null,
        isLeft: false,

        init() {
            this.maxX = this.$refs.field.clientWidth / 2;
            this.maxY = this.$refs.field.clientHeight / 2;

            this.walk();
        },

        walk() {
            this.timer = setInterval(() => {

                let distance = this.random();
                this.isLeft = distance < 0 ? true : false;

                let newX = this.x + distance;
                if ( newX > -this.maxX && newX < this.maxX ) {
                    this.x = newX;
                };

                distance = this.random();

                let newY = this.y + distance;
                if ( newY > -this.maxY && newY < this.maxY ) {
                    this.y = newY;
                };

            }, 1000);
        },

        random() {
            return Math.floor(Math.random() * 101) - 50;
        },
    }"
>

    <div class="h-96 m-6 bg-white rounded-xl shadow border border-gray-700 flex justify-center items-center" x-ref="field">
        <div class="relative">
            <div class="absolute transition-all duration-1000 ease-linear" :style="{ left: x + 'px', top: y + 'px'}">
                <i class="fa-solid fa-dog text-sky-300 text-3xl"
                   :class="{ '-scale-x-100': isLeft }"
                ></i>
            </div>
        </div>
    </div>

</div>
