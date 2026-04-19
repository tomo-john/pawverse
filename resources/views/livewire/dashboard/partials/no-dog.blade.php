<div class="max-w-3xl mx-auto" x-data="noDog('{{ route('dog.index') }}')">

    <div class="relative"
         :style="{
            width: (cols * gridSize) + 'px',
            height: (rows * gridSize) + 'px'
         }"
    >

        {{-- Path --}}
        <div class="absolute bottom-2 right-2 flex justify-center items-center">
            <div class="transition-all duration-[2000ms] ease-in-out cursor-pointer"
                 :class="[houseOpacity, canEnter ? 'hover:scale-110 animate-pulse' : '']"
                 @click="canEnter && goCreate()"
            >
                <i class="fa-solid fa-house text-2xl"
                   :class="[collectedCount >= 5 ? 'scale-125 text-yellow-300 drop-shadow-lg' : 'text-gray-400']"
                ></i>
            </div>
        </div>

        {{-- かつてのおもちゃ --}}
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
                       @click="cleanItem(item)"
                       class="text-gray-300 text-xl animate-pulse transition-all duration-1000 cursor-pointer"
                    ></i>
                </div>
            </div>
        </template>

        {{-- メッセージ --}}
        <div class="absolute inset-0 flex flex-col justify-center items-center pointer-events-none">
            <div class="flex items-center text-gray-400">
                <span x-text="statusMessage"></span>
            </div>
            <div class="mt-2 transition-all duration-[2000ms] ease-in-out" :class="dogOpacity">
                <i class="fa-solid fa-dog" :class="dogAnimation"></i>
            </div>
        </div>
    </div>

    {{-- Console Message Window --}}
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
    function noDog(nextUrl) {

        return {
            nextUrl,

            gridSize: 50,
            cols: 10,
            rows: 6,
            items: [],

            itemsIcon: [
                'fa-solid fa-bone',
                'fa-solid fa-bowl-food',
                'fa-solid fa-bicycle',
                'fa-solid fa-football',
                'fa-solid fa-baseball-ball',
            ],

            message: '',
            overrideMessage: '',

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
                this.message = 'かたづけますか?';
            },

            hideMessage() {
                this.message = '';
            },

            cleanItem(targetItem) {
                targetItem.isCollected = true;
            },

            get collectedCount() {
                return this.items.filter(i => i.isCollected).length;
            },

            get dogAnimation() {
                const count = this.collectedCount;

                if (count >= 5) return '';
                if (count >= 4) return 'animate-bounce';
                if (count >= 2) return 'animate-pulse';
                return '';
            },

            get dogOpacity() {
                const opacities = {
                    0: 'opacity-0',
                    1: 'opacity-0',
                    2: 'opacity-30',
                    3: 'opacity-70',
                    4: 'opacity-100',
                    5: 'opacity-0',
                };
                return opacities[this.collectedCount] || 'opacity-0';
            },

            get houseOpacity() {
                const opacities = {
                    0: 'opacity-0',
                    1: 'opacity-0',
                    2: 'opacity-30',
                    3: 'opacity-60',
                    4: 'opacity-80',
                    5: 'opacity-100',
                };
                return opacities[this.collectedCount] || 'opacity-0';
            },

            get statusMessage() {
                if (this.overrideMessage) return  this.overrideMessage;

                const count = this.collectedCount;

                if (count === 0) return 'まだ誰もいないワン...';
                if (count === 1) return '誰かいたのかワン...？';
                if (count === 2) return '...あっちから気配がするワン';
                if (count === 3) return 'あの子のおもちゃだワン！';
                if (count === 4) return 'もうすぐ、会える気がするワン...！';
                return '待ってるワン。ずっと';
            },

            get canEnter() {
                return this.collectedCount >= 2;
            },

            goCreate() {
                this.overrideMessage = '....!';

                setTimeout(() => {
                    window.location.href = this.nextUrl;;
                }, 800);
            },
        }
    }
</script>
