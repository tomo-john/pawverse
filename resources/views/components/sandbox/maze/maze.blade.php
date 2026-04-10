<div class="flex justify-center items-center mt-6">
    <a href="{{ route('sandbox.page', 'index') }}" class="px-3 py-1 text-pink-500">Back</a>
</div>

<div class="max-w-3xl mx-auto" x-data="maze"
    @keydown.window.arrow-up.prevent="handleKey($event)"
    @keydown.window.arrow-down.prevent="handleKey($event)"
    @keydown.window.arrow-left.prevent="handleKey($event)"
    @keydown.window.arrow-right.prevent="handleKey($event)"
    @keydown.window.shift="isDash = true"
    @keyup.window.shift="isDash = false"
>

    {{-- デバッグ用 --}}
    <div class="flex gap-3 items-center my-4">
        <i class="fa-solid fa-dog text-gray-400 text-xl"></i>
        <span class="text-sm text-gray-400 w-40 inline-block" x-text="`x: ${x}px / y: ${y}px`"></span>
        <i class="fa-solid fa-arrow-pointer text-gray-400 text-xl"></i>
        <span class="text-sm text-gray-400 w-40 inline-block" x-text="`x: ${mouseX}px / y: ${mouseY}px`"></span>
        <i class="fa-solid fa-bone text-gray-400 text-xl"></i>
        <span class="text-sm text-gray-400 w-40 inline-block" x-text="score"></span>
    </div>

    <div class="w-full h-96 border rounded-lg overflow-hidden relative"
         x-ref="field"
         @mousemove="mousePos($event)"

    >
        {{-- Dog(移動判定用の枠) --}}
        <div class="absolute z-20 w-[50px] h-[50px] flex justify-center items-center transition-all"
             :class="{
                'duration-75 rotate-12': isDash && !isLeft && !isResetting,
                'duration-75 -rotate-12': isDash && isLeft && !isResetting,
                'duration-100': !isDash && !isResetting,
                'duration-1000 animate-spin': isResetting,
             }"
             :style="{left: x + 'px', top: y + 'px'}"
             x-ref="dog"
        >
            <i class="fa-solid fa-dog text-yellow-400 text-3xl" :class="isLeft ? '-scale-x-100' : ''"></i>
        </div>

        {{-- Wall --}}
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

        {{-- Bone --}}
        <template x-for="bone in bones">
            <div class="absolute z-10 w-[50px] h-[50px] flex justify-center items-center"
                 :style="{
                    left: bone.x + 'px',
                    top: bone.y + 'px',
                 }"
            >
                <div x-show="!bone.isGet"
                     x-transition.duration.500ms
                >
                    <i class="fa-solid fa-bone"></i>
                </div>
            </div>
        </template>

        {{-- Monsters --}}
        <template x-for="monster in monsters">
            <div class="absolute z-10 w-[50px] h-[50px] flex justify-center items-center"
                 :style="{
                    left: monster.x + 'px',
                    top: monster.y + 'px',
                 }"
            >
                <i class="fa-solid fa-ghost text-2xl text-pink-500"></i>
            </div>
        </template>
    </div>

    <div class="flex justify-center gap-3 my-4">
        <button class="bg-pink-400 hover:bg-pink-500 rounded-lg px-2 py-1 cursor-pointer" @click="reset()">Reset</button>
    </div>
</div>

<script>
    function maze() {

        return {
            x: 0,
            y: 0,
            maxX: 0,
            maxY: 0,
            size: 0,
            isLeft: false,
            isDash: false,
            isResetting: false,

            mouseX: 0,
            mouseY: 0,

            walls: [
                {x: 0, y: 150, w: 50, h: 50},
                {x: 0, y: 250, w: 50, h: 50},
                {x: 50, y: 50, w: 50, h: 50},
                {x: 100, y: 100, w: 50, h: 50},
                {x: 150, y: 0, w: 50, h: 50},
                {x: 150, y: 150, w: 50, h: 50},
                {x: 250, y: 50, w: 100, h: 100},
                {x: 250, y: 200, w: 100, h: 100},
            ],

            bones: [
                {x: 0, y: 50, isGet: false},
                {x: 0, y: 100, isGet: false},
                {x: 50, y: 100, isGet: false},
                {x: 50, y: 150, isGet: false},
                {x: 100, y: 150, isGet: false},
                {x: 100, y: 200, isGet: false},
                {x: 150, y: 200, isGet: false},
                {x: 150, y: 250, isGet: false},
            ],

            monsters: [
                {x: 0, y: 200},
                {x: 300, y: 300},
            ],

            init() {
                this.size = this.$refs.dog.offsetWidth || 50;
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

                this.checkGet();

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

            checkGet() {
                this.bones.forEach(bone => {
                        if (bone.isGet) return;

                        const diffX = Math.abs(this.x - bone.x);
                        const diffY = Math.abs(this.y - bone.y);

                        if (diffX < 25 && diffY < 25) {
                            bone.isGet = true;
                            console.log('骨ゲットだわん🐶');
                        }
                })
            },

            get score() {
                return this.bones.filter(b => b.isGet).length;
            },

            reset() {
                this.isResetting = true;

                this.y = -50;

                setTimeout(() => {
                    this.x = 0;
                    this.isLeft = false;
                }, 1000);

                setTimeout(() => {
                    this.y = 0;
                }, 2000);

                setTimeout(() => {
                    this.isResetting = false;
                    this.bones.forEach(b => b.isGet = false);
                }, 3000);
            },

            mousePos(event) {
                this.mouseX = event.offsetX;
                this.mouseY = event.offsetY;
            },
        }
    }
</script>
