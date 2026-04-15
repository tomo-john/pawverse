<div class="flex justify-center items-center mt-6">
    <a href="{{ route('sandbox.page', 'index') }}" class="px-3 py-1 text-pink-500">Back</a>
</div>

<div class="max-w-3xl mx-auto flex flex-col items-center"
     x-data="walk()"
     @keydown.window="handleKeyDown($event)"
     tabindex="0"
>

    {{-- Field --}}
    <div class="border-4 border-gray-800 rounded-sm bg-yellow-100 overflow-hidden relative"
         :style="{
            width: (config.cols * config.gridSize) + 'px',
            height: (config.rows * config.gridSize) + 'px'
         }"
    >

        {{-- Player --}}
        <div class="absolute z-20 flex justify-center items-center transition-all duration-300"
             :style="{
                left: (player.x * config.gridSize) + 'px',
                top: (player.y * config.gridSize) + 'px',
                width: config.gridSize + 'px',
                height: config.gridSize + 'px',
             }"
        >
            <i class="fa-solid fa-dog text-pink-500 text-2xl"
               :class="{
                    'animate-bounce' : isBumping,
                    '-scale-x-100' : isLeft,
                    'opacity-50' : isInGrass
               }"
            ></i>
        </div>

        {{-- Grass --}}
        <template x-for="grass in grasses">
            <div class="absolute flex justify-center items-center bg-green-200"
                 :style="{
                    left: (grass.x * config.gridSize) + 'px',
                    top: (grass.y * config.gridSize) + 'px',
                    width: config.gridSize + 'px',
                    height: config.gridSize + 'px'
                 }"
            >
                <i class="fa-solid fa-seedling text-green-600 text-lg opacity-60"></i>
            </div>
        </template>

        {{-- Wall --}}
        <template x-for="wall in walls">
            <div class="absolute flex justify-center items-center"
                 :style="{
                    left: (wall.x * config.gridSize) + 'px',
                    top: (wall.y * config.gridSize) + 'px',
                    width: config.gridSize + 'px',
                    height: config.gridSize + 'px'
                 }"
            >
                <i class="fa-solid fa-tree text-green-600 text-2xl"></i>
            </div>
        </template>
    </div>

    <p class="mt-4 text-gray-500 text-sm">矢印キーで移動してみよう！🐶</p>

</div>

<script>
    function walk() {

        return {
            config: {
                gridSize: 40, // 1コマのサイズ
                cols: 30,     // 横に何マスか
                rows: 12,     // 縦に何マスか
            },

            isLeft: false,
            isBumping: false,
            isInGrass: false,
            isMoving: false,

            player: { x: 0, y: 0 },
            walls: [
                { x: 1, y: 1 }, { x: 1, y: 2 },
                { x: 3, y: 0 }, { x: 3, y: 1 },
                { x: 5, y: 3 }, { x: 5, y: 4 },
                { x: 6, y: 3 }, { x: 8, y: 1 },
            ],
            grasses: [
                { x: 0, y: 3 }, { x: 1, y: 3 }, { x: 0, y: 4 }, { x: 1, y: 4 },
                { x: 7, y: 4 }, { x: 7, y: 5 }, { x: 8, y: 4 }, { x: 8, y: 5 },
            ],

            init() {
                this.moveInterval = setInterval(() => {
                    this.updatePosition();
                }, 300)
            },

            handleKeyDown(event) {
                const key = event.key;
                if (!['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight'].includes(key)) return;

                event.preventDefault();

                if (this.isMoving) return;

                this.move(key);

            },

            move(key) {
                let nextX = this.player.x;
                let nextY = this.player.y;

                if (key === 'ArrowUp') nextY--;
                if (key === 'ArrowDown') nextY++;
                if (key === 'ArrowLeft') { nextX--; this.isLeft = true; }
                if (key === 'ArrowRight') { nextX++; this.isLeft = false; }

                const isOutOfBounds = nextX < 0 || nextX >= this.config.cols || nextY < 0 || nextY >= this.config.rows;
                const isWall = this.walls.some(w => w.x === nextX && w.y === nextY);

                if (!isOutOfBounds && !isWall) {
                    this.isMoving = true;
                    this.player.x = nextX;
                    this.player.y = nextY;
                    this.isBumping = false;
                    this.isInGrass = this.grasses.some(g => g.x === nextX && g.y === nextY);

                    setTimeout(() => {
                        this.isMoving = false;
                    }, 300);

                } else {
                    this.isBumping = true;
                    setTimeout(() => this.isBumping = false, 300);
                }
            },
        }
    }
</script>
