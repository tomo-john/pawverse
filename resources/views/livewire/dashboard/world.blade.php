<div class="flex h-full w-full flex-col gap-6">

    @if ($selectedDog)
        @include('livewire.dashboard.partials.with-dog')
    @else
        @include('livewire.dashboard.partials.no-dog')
    @endif

</div>
