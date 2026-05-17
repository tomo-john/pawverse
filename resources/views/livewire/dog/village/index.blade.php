<div class="max-w-5xl mx-auto space-y-10 relative"
     x-data="dogVillage()"
     @keydown.window.arrow-up.prevent="handleKey($event)"
     @keydown.window.arrow-down.prevent="handleKey($event)"
     @keydown.window.arrow-left.prevent="handleKey($event)"
     @keydown.window.arrow-right.prevent="handleKey($event)"
>
    {{-- Fileld --}}
    <div class="max-w-5xl mx-auto flex flex-col justify-center items-center">

        <div class="border rounded-lg overflow-hidden relative"
             :style="{
                width: (config.cols * config.gridSize) + 'px',
                height: (config.rows * config.gridSize) + 'px'
             }"
        >
            {{-- Dog --}}
            <div class="absolute z-20 flex justify-center items-center transition-all duration-300"
                 :class="isLeft ? '-scale-x-100' : 'scale-x-100'"
                 :style="{
                    left: (dog.x * config.gridSize) + 'px',
                    top: (dog.y * config.gridSize) + 'px',
                    width: config.gridSize + 'px',
                    height: config.gridSize + 'px',
                 }"
            >
                <i class="fa-solid fa-dog text-pink-400 text-3xl"></i>
            </div>

            {{-- House --}}
            <div class="absolute z-10 flex justify-center items-center transition-all duration-300"
                 :style="{
                    left: (house.x * config.gridSize) + 'px',
                    top: (house.y * config.gridSize) + 'px',
                    width: config.gridSize + 'px',
                    height: config.gridSize + 'px',
                 }"
            >
                <i class="fa-solid fa-house text-amber-300 text-3xl"></i>
            </div>

            {{-- タイル --}}
            <template x-for="y in config.rows">
                <div class="flex">
                    <template x-for="x in config.cols">
                        <div
                            class="border border-green-100 bg-green-50"
                            :style="{
                                width: config.gridSize + 'px',
                                height: config.gridSize + 'px'
                            }"
                        ></div>
                    </template>
                </div>
            </template>
        </div>

    </div>

</div>

<script>
    function dogVillage() {
        return {
            config: {
                gridSize: 50,
                cols: 28,
                rows: 12,
            },

            isLeft: false,

            dog: { x: 1, y: 1},
            house: { x: 5, y: 3},

            init() {
                console.log('Dog Village Start')
            },

            handleKey(event) {
                switch (event.key) {
                    case 'ArrowUp':
                        if (this.dog.y > 0) this.dog.y--;
                        break;
                    case 'ArrowDown':
                        if (this.dog.y < this.config.rows - 1) this.dog.y++;
                        break;
                    case 'ArrowLeft':
                        this.isLeft = true;
                        if (this.dog.x > 0) this.dog.x--;
                        break;
                    case 'ArrowRight':
                        this.isLeft = false;
                        if (this.dog.x < this.config.cols - 1) this.dog.x++;
                        break;
                }
            },

            // End return
        }
    }
</script>
