<div class="flex justify-center items-center mt-6">
    <a href="{{ route('sandbox.page', 'index') }}" class="px-3 py-1 text-pink-500">Back</a>
</div>

<div class="max-w-3xl mx-auto flex flex-col justify-center items-center" x-data="maze()"
    @keydown.window.arrow-up.prevent="handleKey($event)"
    @keydown.window.arrow-down.prevent="handleKey($event)"
    @keydown.window.arrow-left.prevent="handleKey($event)"
    @keydown.window.arrow-right.prevent="handleKey($event)"
    @keydown.window.shift="isDash = true"
    @keyup.window.shift="isDash = false"
>

    {{-- ステータス --}}
    <div class="w-full max-w-3xl flex justify-between items-center mb-2 px-4 font-bold text-gray-700">
        <div class="flex items-center gap-1">
            <span class="mr-2 text-white">HP:</span>
            <template x-for="i in hp">
                <i class="fa-solid fa-heart text-red-500"></i>
            </template>
            <template x-for="i in (config.maxHp - hp)">
                <i class="fa-regular fa-heart text-gray-300"></i>
            </template>
        </div>

        <div class="flex items-center gap-2 text-xl">
            <i class="fa-solid fa-bone text-yellow-600"></i>
            <span x-text="score" class="text-sm text-white"></span>
            <span class="text-sm text-gray-400">/</span>
            <span class="text-sm text-gray-400" x-text="bones.length"></span>
        </div>
    </div>

    {{-- ゲームエリア --}}
    <div class="border rounded-lg overflow-hidden relative"
         :style="{
            width: (config.cols * config.gridSize) + 'px',
            height: (config.rows * config.gridSize) + 'px'
         }"
         x-ref="field"
    >
        {{-- Player --}}
        <div class="absolute z-20 flex justify-center items-center transition-all duration-300"
             :class="{
                'duration-75 rotate-12': isDash && !isLeft && !isResetting,
                'duration-75 -rotate-12': isDash && isLeft && !isResetting,
                'duration-100': !isDash && !isResetting,
                'duration-1000 animate-spin': isResetting,
             }"
             :style="{
                left: (player.x * config.gridSize) + 'px',
                top: (player.y * config.gridSize) + 'px',
                width: config.gridSize + 'px',
                height: config.gridSize + 'px',
             }"
             x-ref="dog"
        >
            {{-- 主人公Dog --}}
            <i class="fa-solid fa-dog text-pink-400 text-3xl" :class="isLeft ? '-scale-x-100' : ''"></i>
        </div>

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
                <i class="fa-solid fa-tree text-5xl text-green-500"></i>
            </div>
        </template>

        {{-- Bone --}}
        <template x-for="bone in bones">
            <div class="absolute z-10 flex justify-center items-center"
                 :style="{
                    left: (bone.x * config.gridSize) + 'px',
                    top: (bone.y * config.gridSize) + 'px',
                    width: config.gridSize + 'px',
                    height: config.gridSize + 'px',
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
            <div class="absolute z-10 flex justify-center items-center transition-all duration-500"
                 :style="{
                    left: (monster.x * config.gridSize) + 'px',
                    top: (monster.y * config.gridSize) + 'px',
                    width: config.gridSize + 'px',
                    height: config.gridSize + 'px',
                 }"
            >
                <i class="fa-solid fa-ghost text-2xl text-red-400 animate-pulse"></i>
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
            // ゲーム設定値🐶
            config: {
                gridSize: 50,   // 1コマの大きさ
                cols: 10,       // ステージの横幅
                rows: 6,        // ステージの高さ
                maxHp: 3,       // 初期HP
            },

            hp: 0,
            isLeft: false,
            isDash: false,
            isResetting: false,

            player: { x: 0, y: 0 },

            walls: [
                { x: 1, y: 1 },{ x: 1, y: 2 },
                { x: 3, y: 0 },{ x: 3, y: 1 },
            ],

            bones: [
                { x: 3, y: 3, isGet: false },
            ],

            monsters: [
                {x: 2, y: 2, dx: 1, dy: 0},
                {x: 1, y: 3, dx: 0, dy: 1},
            ],

            init() {
                this.hp = this.config.maxHp;
                setInterval(() => {
                    this.moveMonsters();
                }, 500);
            },

            handleKey(event) {
                if (this.isResetting) return;

                let moveDistance = this.isDash ? 2 : 1;
                let nextX = this.player.x;
                let nextY = this.player.y;
                let dx = 0;
                let dy = 0;

                switch (event.key) {
                    case 'ArrowUp':    dy = -1; break;
                    case 'ArrowDown':  dy = 1; break;
                    case 'ArrowLeft':  dx = -1; this.isLeft = true; break;
                    case 'ArrowRight': dx = 1; this.isLeft = false; break;
                }

                for (let i = 0; i < moveDistance; i++) {
                    let testX = nextX + dx;
                    let testY = nextY + dy;

                    if (this.canMove(testX, testY)) {
                        nextX = testX;
                        nextY = testY;
                    } else {
                        break;
                    }
                }

                this.player.x = nextX;
                this.player.y = nextY;

                this.checkGet();
                this.checkHitMonster();

            },

            canMove(gx, gy) {
                const isInsideField =
                    gx >= 0 &&
                    gy >= 0 &&
                    gx < this.config.cols &&
                    gy < this.config.rows;

                if (!isInsideField) return false;
                    　
                const isHitWall = this.walls.some(wall => wall.x === gx && wall.y === gy);

                return !isHitWall;
            },

            checkGet() {
                this.bones.forEach(bone => {
                    if (!bone.isGet && this.isColliding(this.player, bone)) {
                        bone.isGet = true;
                        console.log('骨ゲットだわん🐶');
                    }
                })
            },

            get score() {
                return this.bones.filter(b => b.isGet).length;
            },

            moveMonsters() {
                this.monsters.forEach(monster => {

                    const nextX = monster.x + monster.dx;
                    const nextY = monster.y + monster.dy;

                    if (this.canMove(nextX, nextY)) {
                        monster.x = nextX;
                        monster.y = nextY;
                    } else {
                        monster.dx *= -1;
                        monster.dy *= -1;
                    }

                    this.checkHitMonster();
                })
            },

            checkHitMonster() {
                if (this.isResetting) return;

                this.monsters.forEach(monster => {
                    if (this.isColliding(this.player, monster)) {
                        console.log('ぎゃふん🐶');
                        this.hp--;
                        this.reset();
                    }
                });

                if (this.hp <= 0) {
                    console.log('GAME OVER🐶');
                    this.hp = this.config.maxHp;
                    // ここで後で特別な処理を書く
                }
            },

            isColliding(objA, objB) {
                return objA.x === objB.x && objA.y === objB.y;
            },

            reset() {
                this.isResetting = true;

                this.player.y = -1;

                setTimeout(() => {
                    this.player.x = 0;
                    this.isLeft = false;
                }, 1000);

                setTimeout(() => {
                    this.player.y = 0;
                }, 2000);

                setTimeout(() => {
                    this.isResetting = false;
                    this.bones.forEach(b => b.isGet = false);
                }, 3000);
            },

        }
    }
</script>
