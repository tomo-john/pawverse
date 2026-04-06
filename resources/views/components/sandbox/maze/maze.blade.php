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
        <div class="absolute transition-all duration-100"
             :style="{left: x + 'px', top: y + 'px'}"
        >
            <i class="fa-solid fa-dog text-white"
               :class="isLeft ? '-scale-x-100' : ''"
            ></i>
        </div>
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
            isLeft: false,

            init() {
                this.maxX = this.$refs.field.clientWidth - 30;
                this.maxY = this.$refs.field.clientHeight - 30;
            },

            clamp(val, min, max) {
                return Math.min(Math.max(val, min), max);
            },

            handleKey(event) {
                const step = 10;
                switch (event.key) {
                    case 'ArrowUp':
                        this.y = this.clamp(this.y - step, 0, this.maxY);
                        break;

                    case 'ArrowDown':
                        this.y = this.clamp(this.y + step, 0, this.maxY);
                        break;

                    case 'ArrowLeft':
                        this.isLeft = true;
                        this.x = this.clamp(this.x - step, 0, this.maxX);
                        break;

                    case 'ArrowRight':
                        this.isLeft = false;
                        this.x = this.clamp(this.x + step, 0, this.maxX);
                        break;
                }

            },

        }
    }
</script>
