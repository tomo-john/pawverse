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

    <div class="border rounded-lg overflow-hidden relative"
         :style="{
            width: (config.cols * config.gridSize) + 'px',
            height: (config.rows * config.gridSize) + 'px'
         }"
         x-ref="field"
         @mousemove="mousePos($event)"

    >
        {{-- Dog(移動判定用の枠) --}}
        <div class="absolute z-20 flex justify-center items-center transition-all"
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
            <div class="absolute bg-green-500"
                 :style="{
                    left: (wall.x * config.gridSize) + 'px',
                    top: (wall.y * config.gridSize) + 'px',
                    width: config.gridSize + 'px',
                    height: config.gridSize + 'px'
                 }"
            ></div>
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
            <div class="absolute z-10 w-[50px] h-[50px] flex justify-center items-center transition-all duration-500"
                 :style="{
                    left: monster.x + 'px',
                    top: monster.y + 'px',
                 }"
            >
                <i class="fa-solid fa-ghost text-2xl text-pink-500 animate-pulse"></i>
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
                dogSize: 50,    // わんちゃんの大きさ
                gridSize: 50,   // 1コマの大きさ
                cols: 10,       // ステージの横幅
                rows: 6,        // ステージの高さ
                maxHp: 3,       // 初期HP
                hitMargin: 25,  // 当たり判定の距離
                step: 10,       // 通常の移動距離
                dashStep: 20,   // ダッシュ時の移動距離
            },

            player: { x: 0, y: 0 },

            hp: 0,
            x: 0,
            y: 0,
            maxX: 0,
            maxY: 0,
            isLeft: false,
            isDash: false,
            isResetting: false,

            mouseX: 0,
            mouseY: 0,

            walls: [
                { x: 1, y: 1 },
                { x: 1, y: 2 },
                { x: 3, y: 0 },
                { x: 3, y: 1 },
            ],

            bones: [
                { x: 3, y: 3, isGet: false },
            ],

            monsters: [
                {x: 0, y: 200, dx: 10, dy: 0},
                {x: 350, y: 150, dx: 0, dy: 10},
            ],

            init() {
                this.hp = this.config.maxHp;
                this.maxX = this.$refs.field.clientWidth - this.size;
                this.maxY = this.$refs.field.clientHeight - this.size;
                setInterval(() => {
                    this.moveMonsters();
                }, 500);
            },

            handleKey(event) {
                if (this.isResetting) return;

                const step = event.shiftKey ? this.config.dashStep : this.config.step;
                let nextX = this.player.x;
                let nextY = this.player.y;

                switch (event.key) {
                    case 'ArrowUp':    nextY--; break;
                    case 'ArrowDown':  nextY++; break;
                    case 'ArrowLeft':  nextX--; this.isLeft = true; break;
                    case 'ArrowRight': nextX++; this.isLeft = false; break;
                }

                if (this.canMove(nextX, nextY)) {
                        this.player.x = nextX;
                        this.player.y = nextY;
                }

                this.checkGet();
                this.checkHitMonster();

            },

            canMove(gx, gy) {
                const isInsideField =
                    gx >= 0 &&
                    gy >= 0 &&
                    gx <= this.config.cols &&
                    gy <= this.config.rows;

                if (!isInsideField) return false;
                    　
                const isHitWall = this.walls.some(wall => wall.x === gx && wall.y === gy);

                return !isHitWall;
            },

            checkGet() {
                this.bones.forEach(bone => {
                    if (!bone.isGet && this.isColliding(this, bone)) {
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

                    const newX = monster.x + monster.dx;
                    const newY = monster.y + monster.dy;

                    if (this.canMove(newX, newY)) {
                        monster.x = newX;
                        monster.y = newY;
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
                    if (this.isColliding(this, monster)) {
                        console.log('ぎゃふん🐶');
                        this.hp--;
                        this.reset();
                    }

                    if (this.hp <= 0) {
                        console.log('GAME OVER🐶');
                        this.hp = this.config.maxHp;
                        // ここで後で特別な処理を書く
                    }
                });
            },

            isColliding(objA, objB) {
                return objA.x === objB.x && objA.y === objB.y;
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

            // デバッグ用
            mousePos(event) {
                this.mouseX = event.offsetX;
                this.mouseY = event.offsetY;
            },
        }
    }
</script>
