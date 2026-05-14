<div class="flex flex-col gap-6">

    @if ($dogs->isNotEmpty())
        @include('livewire.dog.partials.with-dog')
    @else
        @include('livewire.dog.partials.no-dog')
    @endif

</div>
