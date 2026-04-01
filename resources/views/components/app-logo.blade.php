@props([
    'sidebar' => false,
])

@if($sidebar)
    <flux:sidebar.brand name="pawverse" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground">
            <i class="fa-solid fa-dog text-lg"></i>
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand name="pawverse" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground">
            <i class="fa-solid fa-dog text-lg"></i>
        </x-slot>
    </flux:brand>
@endif
