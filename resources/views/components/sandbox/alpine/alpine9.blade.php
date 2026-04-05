<div x-data="animate()">

    <div class="m-6 p-6 bg-white rounded-xl shadow border border-gray-700 flex flex-col gap-3">

        <div>
            <button class="bg-green-500 rounded-lg px-2 py-1 cursor-pointer" @click="stop()">Stop</button>
        </div>
        <div class="bg-green-200 rounded-lg w-full p-6 flex items-center relative">
            <div class="transition-all duration-1000 absolute" :style="{ left: x1 + 'px'}">
                <i class="fa-solid fa-dog text-green-500 text-3xl"></i>
            </div>
        </div>

        <div>
            <button class="bg-red-500 rounded-lg px-2 py-1 cursor-pointer" @click="stopRed()">Stop</button>
        </div>
        <div class="bg-red-200 rounded-lg w-full p-6 flex items-center relative">
            <div class="absolute" :style="{ left: x2 + 'px'}">
                <i class="fa-solid fa-dog text-red-500 text-3xl"></i>
            </div>
        </div>

    </div>

</div>

<script>
    function animate() {
        return {
            x1: 0,
            x2: 0,
            timer: null,
            requestID: null,

            init() {
                this.walk();
                this.walkRed();
            },

            walk() {
                this.timer = setInterval(() => {
                    this.x1 += 10;
                }, 1000);
            },

            stop() {
                clearInterval(this.timer);
            },

            walkRed() {
                this.x2 += 0.166;
                this.requestID = requestAnimationFrame(() => this.walkRed());
            },

            stopRed() {
                if (this.requestID) {
                    cancelAnimationFrame(this.requestID);
                    this.requestID = null;
                }
            },
        }
    }
</script>
