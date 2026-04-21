<div class="relative w-full h-[400px] bg-green-100 overflow-hidden"
     x-data="world()"
     x-ref="world"
     @mousemove="mouseX = $event.offsetX; mouseY = $event.offsetY"
>

    @include('livewire.dashboard.partials.dog-actor')

</div>

<script>
    function world() {
        return {
            selectedDog: {{ Js::from($selectedDog) }},
            behavior: {{ Js::from($behavior) }},
            mouseX: 0,
            mouseY: 0,
        }
    }
</script>
