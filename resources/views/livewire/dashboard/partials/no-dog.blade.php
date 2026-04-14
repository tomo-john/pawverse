<div class="max-w-3xl mx-auto" x-data="noDog()">

    <div class="relative"
         :style="{
            width: (cols * gridSize) + 'px',
            height: (rows * gridSize) + 'px'
         }"
    >

        {{-- 散らばったおもちゃ --}}
        <template x-for="(item, index) in items":key="index">
            <div class="absolute flex justify-center items-center"
                 :style="{
                    left: (item.x * gridSize) + 'px',
                    top: (item.y * gridSize) + 'px',
                    width: gridSize + 'px',
                    height: gridSize + 'px',
                 }"
            >
                <i :class="item.icon"
                    class="text-gray-300 text-xl animate-pulse transition-all duration-1000"
                ></i>
            </div>
        </template>

        {{-- メッセージ --}}
        <div class="absolute inset-0 flex justify-center items-center pointer-events-none">
            <span class="text-gray-400">まだ誰もいないワン...</span>
        </div>

        {{-- かつて犬がいた場所 --}}
        <div class="absolute flex justify-center items-center opacity-20"
             :style="{
                left: (reservedSpace.x * gridSize) + 'px',
                top: (reservedSpace.y * gridSize) + 'px',
                width: gridSize + 'px',
                height: gridSize + 'px',
             }"
        >
            <i class="fa-solid fa-paw text-xl text-gray-400 animate-pulse duration-300"></i>
        </div>
    </div>
</div>

<script>
    function noDog() {

        return {
            gridSize: 50,
            cols: 10,
            rows: 6,
            items: [],

            itemsCount: 5,
            itemsIcon: [
                'fa-solid fa-bone',
                'fa-solid fa-bowl-food',
                'fa-solid fa-football',
                'fa-solid fa-baseball-ball',
                'fa-solid fa-house'
            ],

            reservedSpace: { x: 4, y: 2 },

            init() {
                this.initItems();
            },

            initItems() {
                this.itemsIcon.forEach(iconClass => {
                    let x, y, isOccupied;

                    do {
                        x = Math.floor(Math.random() * this.cols),
                        y = Math.floor(Math.random() * this.rows)

                        isOccupied = this.items.some(i => i.x === x && i.y === y)
                                     || (x === this.reservedSpace.x && y === this.reservedSpace.y);

                    } while (isOccupied);

                    this.items.push({
                        icon: iconClass,
                        x: x,
                        y: y
                    });
                });
            },
        }
    }
</script>
