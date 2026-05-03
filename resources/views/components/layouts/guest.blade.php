<x-layouts.base>
    <div class="fixed inset-0 pointer-events-none opacity-[0.03]">
        <i class="fa-solid fa-dog absolute top-20 left-10 text-8xl rotate-12"></i>
        <i class="fa-solid fa-paw absolute bottom-10 right-10 text-8xl -rotate-12"></i>
    </div>

    <div class="relative z-10">
        {{ $slot }}
    </div>
</x-layouts.base>
