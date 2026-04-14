<div class="max-w-3xl mx-auto" x-data="noDog()">

    <div class="relative border rounded-lg"
         :style="{
            width: (cols * gridSize) + 'px',
            height: (rows * gridSize) + 'px'
         }"
    >

        <template x-for="item in items">
            <div class="absolute flex justify-center items-center"
                 :style="{
                    left: (item.x * gridSize) + 'px',
                    top: (item.y * gridSize) + 'px',
                    width: gridSize + 'px',
                    height: gridSize + 'px',
                 }"
            >
                <i class="fa-solid fa-bone"></i>
            </div>
        </template>
    </div>
</div>

<script>
    function noDog() {

        return {
            gridSize: 50,
            cols: 10,
            rows: 6,
            items: [
                { x: 2, y: 2 },
                { x: 3, y: 3 },
            ],
        }
    }
</script>
