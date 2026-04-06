<div class="flex justify-center items-center mt-6">
    <a href="{{ route('sandbox.page', 'index') }}" class="px-3 py-1 text-pink-500">Back</a>
</div>

<div x-data="maze"
     @keydown.window.prevent="handleKey($event)"
>

    <div class="w-full h-96 border rounded-lg relative">

        <div class="absolute"
             :style="{left: x + 'px', top: y + 'px'}"
        >
            <i class="fa-solid fa-dog text-white"></i>

        </div>

</div>

<script>
    function maze() {

        return {
            x: 0,
            y: 0,

            handleKey(event) {
                console.log('押されたキーは:', event.key);

                if (event.key === 'ArrowUp') {
                    this.y -= 10;
                }

                if (event.key === 'ArrowDown') {
                    this.y += 10;
                }

                if (event.key === 'ArrowLeft') {
                    this.x -= 10;
                }

                if (event.key === 'ArrowRight') {
                    this.x += 10;
                }

            },

        }
    }
</script>
