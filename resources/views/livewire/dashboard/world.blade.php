<div class="flex flex-col gap-6">

    @if ($dogs->isNotEmpty())
        @include('livewire.dashboard.partials.with-dog')
    @else
        @include('livewire.dashboard.partials.no-dog')
    @endif

</div>
