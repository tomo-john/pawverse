<div class="flex justify-center items-center mt-6">
    <a href="{{ route('sandbox.page', 'index') }}" class="px-3 py-1 text-pink-500">Back</a>
</div>

<div class="max-w-3xl mx-auto" x-data="maze"
     @keydown.window.arrow-up.prevent="handleKey($event)"
     @keydown.window.arrow-down.prevent="handleKey($event)"
     @keydown.window.arrow-left.prevent="handleKey($event)"
     @keydown.window.arrow-right.prevent="handleKey($event)"
>

    <div class="flex gap-3 items-center my-4">
        <i class="fa-solid fa-dog text-gray-400 text-3xl"></i>
        <span class="text-sm text-gray-400" x-text="`x: ${x}px / y: ${y}px`"></span>
    </div>

    <div class="w-full h-96 border rounded-lg overflow-hidden relative" x-ref="field">
        <div class="absolute transition-all"
             :class="isResetting ? 'duration-1000 animate-spin' : 'duration-100'"
             :style="{left: x + 'px', top: y + 'px'}"
             x-ref="dog"
        >
            <i class="fa-solid fa-dog text-white text-3xl" :class="isLeft ? '-scale-x-100' : ''"></i>
        </div>

        <template x-for="wall in walls">
            <div class="absolute bg-green-500 opacity-50"
                 :style="{
                    left: wall.x + 'px',
                    top: wall.y + 'px',
                    width: wall.w + 'px',
                    height: wall.h + 'px'
                 }"
            ></div>
        </template>
    </div>

    <div class="flex justify-center gap-3 my-4">
        <button class="bg-pink-400 hover:bg-pink-500 rounded-lg px-2 py-1 cursor-pointer" @click="reset()">Reset</button>
    </div>
</div>

<script>
    function maze() {

        return {
            x: 10,
            y: 10,
            maxX: 0,
            maxY: 0,
            size: 0,
            isLeft: false,
            isResetting: false,

            walls: [
                {x: 50, y: 50, w: 50, h: 50},
                {x: 100, y: 100, w: 50, h: 50},
                {x: 150, y: 150, w: 50, h: 50},
                {x: 300, y: 150, w: 100, h: 100},
                {x: 400, y: 50, w: 200, h: 50},
            ],

            init() {
                this.size = this.$refs.dog.offsetWidth || 40;
                this.maxX = this.$refs.field.clientWidth - this.size;
                this.maxY = this.$refs.field.clientHeight - this.size;
            },

            handleKey(event) {
                if (this.isResetting) return;

                if (this.size === 0) {
                    this.size = this.$refs.dog.offsetWidth;
                }

                const step = event.shiftKey ? 20 : 10;
                let newX = this.x;
                let newY = this.y;

                switch (event.key) {
                    case 'ArrowUp':
                        newY -= step;
                        break;

                    case 'ArrowDown':
                        newY += step;
                        break;

                    case 'ArrowLeft':
                        this.isLeft = true;
                        newX -= step;
                        break;

                    case 'ArrowRight':
                        this.isLeft = false;
                        newX += step;
                        break;
                }

                if (this.canMove(newX, newY)) {
                        this.x = newX;
                        this.y = newY;
                }

            },

            canMove(tempX, tempY) {
                const isInsideField =
                    tempX >= 0 &&
                    tempY >= 0 &&
                    tempX + this.size <= this.$refs.field.clientWidth &&
                    tempY + this.size -6 <= this.$refs.field.clientHeight;

                if (!isInsideField) return false;
                    　
                const isHitWall = this.walls.some(wall => {
                    return (
                        tempX < wall.x + wall.w &&
                        tempX + this.size > wall.x &&
                        tempY < wall.y + wall.h &&
                        tempY + this.size -6 > wall.y
                    );
                });

                return !isHitWall;
            },

            reset() {
                this.isResetting = true;

                this.y = -50;

                setTimeout(() => {
                    this.x = 10;
                    this.isLeft = false;
                }, 1000);

                setTimeout(() => {
                    this.y = 10;
                }, 2000);

                setTimeout(() => {
                    this.isResetting = false;
                }, 3000);
            },
        }
    }
</script>
