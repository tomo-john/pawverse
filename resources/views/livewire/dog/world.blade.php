<div class="flex flex-col gap-6">

    @if ($dogs->isNotEmpty())
        @include('livewire.dog.world.with-dog')
    @else
        @include('livewire.dog.world.no-dog')
    @endif

</div>
