<div class="relative w-full h-[400px] bg-green-100 overflow-hidden" x-data="world()" x-ref="world"
>

    @include('livewire.dashboard.partials.dog-actor')

</div>

<script>
    function world() {
        return {
            selectedDog: {{ Js::from($selectedDog) }},
        }
    }
</script>
