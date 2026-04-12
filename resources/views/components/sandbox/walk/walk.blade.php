<div class="flex justify-center items-center mt-6">
    <a href="{{ route('sandbox.page', 'index') }}" class="px-3 py-1 text-pink-500">Back</a>
</div>

<div class="max-w-3xl mx-auto flex flex-col items-center"
     x-data="walk()"
     @keydown.window="move($event.key)"
     tabindex="0"
>

    {{-- Field --}}
    <div class="border-4 border-gray-800 rounded-sm bg-gray-100 overflow-hidden relative"
         :style="{
            width: (config.cols * config.gridSize) + 'px',
            height: (config.rows * config.gridSize) + 'px'
         }"
    >

        {{-- Player --}}
        <div class="absolute z-20 flex justify-center items-center transition-all duration-100"
             :style="{
                left: (player.x * config.gridSize) + 'px',
                top: (player.y * config.gridSize) + 'px',
                width: config.gridSize + 'px',
                height: config.gridSize + 'px',
             }"
        >
            <i class="fa-solid fa-dog text-pink-500 text-2xl"
               :class="isBumping ? 'animate-bounce' : ''"
            ></i>
        </div>

        {{-- Wall --}}
        <template x-for="wall in walls">
            <div class="absolute flex justify-center items-center bg-green-200 border border-green-300"
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
                cols: 10,     // 横に何マスか
                rows: 6,      // 縦に何マスか
            },

            isBumping: false,

            player: { x: 0, y: 0 },
            walls: [
                { x: 1, y: 1 }, { x: 1, y: 2 },
                { x: 3, y: 0 }, { x: 3, y: 1 },
                { x: 5, y: 3 }, { x: 5, y: 4 },
                { x: 6, y: 3 }, { x: 8, y: 1 },
            ],

            move(key) {
            },
        }
    }
</script>
