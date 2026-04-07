<div class="flex justify-center items-center mt-6">
    <a href="{{ route('sandbox.page', 'index') }}" class="px-3 py-1 text-pink-500">Back</a>
</div>

<div x-data="maze"
     @keydown.window.arrow-up.prevent="handleKey($event)"
     @keydown.window.arrow-down.prevent="handleKey($event)"
     @keydown.window.arrow-left.prevent="handleKey($event)"
     @keydown.window.arrow-right.prevent="handleKey($event)"
>

    <div class="w-full h-96 border rounded-lg overflow-hidden relative" x-ref="field">
        <div class="absolute transition-all duration-100" :style="{left: x + 'px', top: y + 'px'}">
            <i class="fa-solid fa-dog text-white" :class="isLeft ? '-scale-x-100' : ''"></i>
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

    <div class="my-4">
        <span class="text-sm text-gray-400" x-text="`x: ${x}px / y: ${y}px`"></span>
    </div>
</div>

<script>
    function maze() {

        return {
            x: 0,
            y: 0,
            maxX: 0,
            maxY: 0,
            size: 20,
            isLeft: false,

            walls: [
                {x: 200, y: 100, w: 50, h: 50},
                {x: 250, y: 150, w: 50, h: 50},
            ],

            init() {
                this.maxX = this.$refs.field.clientWidth - this.size;
                this.maxY = this.$refs.field.clientHeight - this.size;
            },

            clamp(val, min, max) {
                return Math.min(Math.max(val, min), max);
            },

            handleKey(event) {
                const step = 10;
                let newX = this.x;
                let newY = this.y;

                switch (event.key) {
                    case 'ArrowUp':
                        newY = this.clamp(this.y - step, 0, this.maxY);
                        break;

                    case 'ArrowDown':
                        newY = this.clamp(this.y + step, 0, this.maxY);
                        break;

                    case 'ArrowLeft':
                        this.isLeft = true;
                        newX = this.clamp(this.x - step, 0, this.maxX);
                        break;

                    case 'ArrowRight':
                        this.isLeft = false;
                        newX = this.clamp(this.x + step, 0, this.maxX);
                        break;
                }

                if (this.canMove(newX, newY)) {
                        this.x = newX;
                        this.y = newY;
                }

            },

            canMove(tempX, tempY) {
                const isHit = this.walls.some(wall => {
                    return (tempX < wall.x + wall.w && tempX + this.size > wall.x && tempY < wall.y + wall.h && tempY + this.size > wall.y)
                });

                return !isHit;
            },
        }
    }
</script>
