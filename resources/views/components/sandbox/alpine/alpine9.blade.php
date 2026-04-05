<div x-data="animate()">

    <div class="m-6 p-6 bg-white rounded-xl shadow border border-gray-700 flex flex-col items-center gap-3">

        <div class="bg-green-200 rounded-lg w-full p-6 flex items-center relative">
            <div class="transition-all duration-1000 absolute" :style="{ left: x + 'px'}">
                <i class="fa-solid fa-dog text-green-500 text-3xl"></i>
            </div>
        </div>

        <div class="bg-red-200 rounded-lg w-full p-6 flex items-center relative">
            <div class="transition-all duration-1000 absolute" :style="{ left: x + 'px'}">
                <i class="fa-solid fa-dog text-red-500 text-3xl"></i>
            </div>
        </div>

    </div>

</div>

<script>
    function animate() {
        return {
            x: 0,
            timer: null,

            init() {
                this.walk();
            },

            walk() {
                timer = setInterval(() => {
                    this.x += 10;
                }, 1000);
            },
        }
    }
</script>
