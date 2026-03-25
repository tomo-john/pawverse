<div class="max-w-5xl mx-auto space-y-4">

    <flux:heading size="xl">
        <i class="fa-solid fa-paw"></i>
        Pawverse Dog
    </flux:heading>

    <x-dog.toast />

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center">

        {{-- Form --}}
        <div class="lg:col-span-2">
            @include('livewire.dog.index._form')
        </div>

        {{-- Preview --}}
        <div class="lg:col-span-1">
            @include('livewire.dog.index._preview')
        </div>

    </div>

    <flux:separator variant="subtle" class="my-6" />

    <!-- Index -->
    @include('livewire.dog.index._list')

</div>
