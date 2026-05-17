<div class="max-w-5xl mx-auto space-y-10 relative"
     x-data="dogVillage()"
>

    {{-- Dogs --}}
    <div class="max-w-5xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
        @foreach($this->dogs as $dog)
            @include('livewire.dog.village.dogs')
        @endforeach
    </div>

    {{-- Fileld --}}

</div>

<script>
    function dogVillage() {
        return {
            init() {
                console.log('Dog Village Start')
            },
        }
    }
</script>
