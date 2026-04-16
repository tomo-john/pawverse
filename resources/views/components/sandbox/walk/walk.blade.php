<div class="flex justify-center items-center my-8">
    <a href="{{ route('sandbox.page', 'index') }}" class="px-3 py-1 text-pink-500">Back</a>
</div>

<div class="max-w-3xl mx-auto flex flex-col items-center"
     x-data="walk()"
     @keydown.window="handleKeyDown($event)"
     tabindex="0"
>

    {{-- Field --}}
    <div class="relative border-4 border-gray-800 rounded-sm bg-yellow-100"
         :style="{
            width: (config.cols * config.gridSize) + 'px',
            height: (config.rows * config.gridSize) + 'px'
         }"
    >


        {{-- Status --}}
        <div class="absolute -top-16 left-0 flex gap-3">
            <div class="bg-white border-2 border-gray-800 p-2 rounded shadow-sm flex items-center gap-2">
                <i :class="[player.icon, player.color]" class="text-xl"></i>
                <p x-text="player.name" class="font-bold text-gray-800"></p>
                <p x-text="'Lv. ' + player.level" class="font-bold text-gray-600 text-sm"></p>
            </div>
            <div class="bg-white border-2 border-gray-800 p-2 rounded shadow-sm flex items-center gap-2">
                <i :class="[buddy.icon, buddy.color]" class="text-xl"></i>
                <p x-text="buddy.name" class="font-bold text-gray-800"></p>
                <p x-text="'Lv. ' + buddy.level" class="font-bold text-gray-600 text-sm"></p>
            </div>
        </div>

        {{-- Player --}}
        <div class="absolute z-20 flex justify-center items-center transition-all duration-300"
             :style="{
                left: (player.x * config.gridSize) + 'px',
                top: (player.y * config.gridSize) + 'px',
                width: config.gridSize + 'px',
                height: config.gridSize + 'px',
             }"
        >
            <i class="text-2xl"
               :class="[
                    player.icon,
                    player.color,
                    isMoving ? 'rotate-12' : '',
                    isBumping ? 'animate-bounce' : '',
                    isLeft ? '-scale-x-100' : '',
                    isInGrass ? 'opacity-50' : ''
               ]"
            ></i>
        </div>

        {{-- Buddy --}}
        <div class="absolute z-10 flex justify-center items-center transition-all duration-300"
             :style="{
                left: (buddy.x * config.gridSize) + 'px',
                top: (buddy.y * config.gridSize) + 'px',
                width: config.gridSize + 'px',
                height: config.gridSize + 'px',
             }"
        >
            <i class="text-2xl"
               :class="[
                    buddy.icon,
                    buddy.color,
                    isMoving ? '-rotate-12' : '',
                    isBumping ? 'animate-bounce' : '',
                    isLeft ? '-scale-x-100' : '',
                    isInGrass ? 'opacity-50' : ''
               ]"
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

        {{-- Items --}}
        <template x-for="item in items">
            <div x-show="item.active"
                 x-transition.duration.500ms
                 class="absolute flex justify-center items-center"
                 :style="{
                    left: (item.x * config.gridSize) + 'px',
                    top: (item.y * config.gridSize) + 'px',
                    width: config.gridSize + 'px',
                    height: config.gridSize + 'px'
                 }"
            >
                <i class="fa-solid fa-bone text-yellow-600 animate-pulse"></i>
            </div>
        </template>

    </div>

    <p class="mt-4 text-gray-500 text-sm">矢印キーで移動してみよう！🐶</p>

    {{-- Message Window --}}
    <div class="w-full bg-white border-4 border-gray-800 p-3 rounded shadow-lg">
        <div class="flex flex-col">
            <span class="text-[10px] text-gray-400 font-bold" x-text="buddy.name"></span>
            <p x-text="message" class="text-gray-800 font-bold text-sm"></p>
            <span class="text-[8px] text-pink-500 animate-bounce self-end">▼ Press Space</span>
        </div>
    </div>
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

            player: {
                x: 0,
                y: 0,
                name: 'じょん',
                icon: 'fa-solid fa-dog',
                color: 'text-pink-500',
                level: 1,
            },

            lastPlayerPos: { x: 0, y: 0 },

            buddy: {
                x: 0,
                y: 0,
                name: 'ぴょんきち',
                icon: 'fa-solid fa-dog',
                color: 'text-black',
                level: 1,
            },

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

            items: [
                { x: 5, y: 2, type: 'bone', active: true},
                { x: 10, y: 5, type: 'bone', active: true},
                { x: 15, y: 8, type: 'bone', active: true},
            ],

            init () {
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
                    this.lastPlayerPos = { x: this.player.x, y: this.player.y };
                    this.isMoving = true;
                    this.player.x = nextX;
                    this.player.y = nextY;
                    this.isBumping = false;
                    this.isInGrass = this.grasses.some(g => g.x === nextX && g.y === nextY);

                    const item = this.items.find(i => i.x === nextX && i.y === nextY && i.active);
                    if (item) {
                        item.active = false;
                        this.player.level++;
                    }

                    this.buddy.x = this.lastPlayerPos.x;
                    this.buddy.y = this.lastPlayerPos.y;

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
