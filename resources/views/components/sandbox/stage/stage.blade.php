<div class="flex justify-center items-center mt-6">
    <a href="{{ route('sandbox.page', 'index') }}" class="px-3 py-1 text-pink-500">Back</a>
</div>

<div class="max-w-3xl mx-auto flex justify-center" x-data="stage()">

    <div class="border rounded-lg overflow-hidden relative"
         :style="{
            width: (config.cols * config.gridSize) + 'px',
            height: (config.rows * config.gridSize) + 'px'
         }"
    >
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

        <div class="absolute z-20 flex justify-center items-center transition-all duration-100"
             :style="{
                left: (player.x * config.gridSize) + 'px',
                top: (player.y * config.gridSize) + 'px',
                width: config.gridSize + 'px',
                height: config.gridSize + 'px',
             }"
        >
            <i class="fa-solid fa-dog text-pink-400 text-3xl"></i>
        </div>
    </div>
</div>

<script>
    function stage() {
        return {
            config: {
                gridSize: 50, // 1コマのサイズ
                cols: 10,     // 横に何マスか
                rows: 6,      // 縦に何マスか
            },

            player: { x: 0, y: 0 },

            walls: [
                { x: 1, y: 1 },
                { x: 1, y: 2 },
                { x: 3, y: 0 },
                { x: 3, y: 1 },
            ],

            init() {
                console.log('ステージ準備完了🐶')
            },
        }
    }
</script>
