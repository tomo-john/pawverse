<div class="relative w-full h-[400px] bg-green-100 cursor-pointer overflow-hidden"
     x-data="world()"
     x-ref="world"
     @mousemove="mouseX = $event.offsetX; mouseY = $event.offsetY"
>

    @foreach ($dogs as $dog)
        @include('livewire.dashboard.partials.dog-actor', [
            'dog' => $dog,
            'behavior' => $behaviors[$dog->id]
        ])
    @endforeach

</div>

<script>
    function world() {
        return {
            mouseX: 0,
            mouseY: 0,

            init() {
                const width = this.$refs.world.clientWidth;
                const height = this.$refs.world.clientHeight;

                this.mouseX = width / 2;
                this.mouseY = height / 2;
            },
        }
    }
</script>
