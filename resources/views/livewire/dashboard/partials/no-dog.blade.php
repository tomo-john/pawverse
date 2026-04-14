<div class="max-w-3xl mx-auto" x-data="noDog()">

    <div class="relative"
         :style="{
            width: (cols * gridSize) + 'px',
            height: (rows * gridSize) + 'px'
         }"
    >

        <template x-for="(item, index) in items":key="index">
            <div class="absolute flex justify-center items-center"
                 :style="{
                    left: (item.x * gridSize) + 'px',
                    top: (item.y * gridSize) + 'px',
                    width: gridSize + 'px',
                    height: gridSize + 'px',
                 }"
            >
                <i :class="item.icon" class="text-pink-400 text-xl"></i>
            </div>
        </template>

        <div class="absolute inset-0 flex justify-center items-center pointer-events-none">
            <span class="text-gray-400">まだ誰もいないワン...</span>
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

            init() {
                this.initItems();
            },

            initItems() {
                this.itemsIcon.forEach(iconClass => {
                    this.items.push({
                        icon: iconClass,
                        x: Math.floor(Math.random() * this.cols),
                        y: Math.floor(Math.random() * this.rows)
                    });
                });
            },
        }
    }
</script>
