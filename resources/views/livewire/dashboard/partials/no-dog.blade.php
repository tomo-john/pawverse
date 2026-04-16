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
                <div x-show="!item.isCollected"
                     x-transition.duration.500ms
                >
                    <i :class="item.icon"
                       @mouseenter="showMessage()"
                       @mouseleave="hideMessage()"
                       @click="cleanItem(index)"
                       class="text-gray-300 text-xl animate-pulse transition-all duration-1000 cursor-pointer"
                    ></i>
                </div>
            </div>
        </template>

        {{-- メッセージ --}}
        <div class="absolute inset-0 flex justify-center items-center pointer-events-none">
            <span class="text-gray-400"><i class="fa-solid fa-paw mx-1"></i>まだ誰もいないワン...</span>
        </div>

    </div>

    {{-- Message Window --}}
    <div class="w-full bg-gray-100/80 border-4 border-gray-400 p-4 rounded-lg shadow-inner mt-6"
         x-show="message"
         x-transition.opacity.duration.500ms
    >
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-circle-question text-gray-400 animate-pulse"></i>
            <p x-text="message" class="text-gray-500 font-bold text-sm"></p>
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

            message: '',

            init() {
                this.initItems();
            },

            initItems() {
                this.itemsIcon.forEach(iconClass => {
                    let x, y, isOccupied;

                    do {
                        x = Math.floor(Math.random() * this.cols),
                        y = Math.floor(Math.random() * this.rows)

                        isOccupied = this.items.some(i => i.x === x && i.y === y);

                    } while (isOccupied);

                    this.items.push({
                        icon: iconClass,
                        x: x,
                        y: y,
                        isCollected: false
                    });
                });
            },

            showMessage() {
                this.message = 'おもちゃをかたずけるわん...?';
            },

            hideMessage() {
                this.message = '';
            },

            cleanItem(index) {
                console.log('わうん🐶' + index);
            },
        }
    }
</script>
