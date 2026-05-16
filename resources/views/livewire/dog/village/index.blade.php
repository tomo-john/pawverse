<div class="max-w-5xl mx-auto space-y-10 relative">

    {{-- Background --}}
    <div class="absolute inset-0 pointer-events-none opacity-[0.04]">
        <i class="fa-solid fa-paw absolute top-10 -left-10 text-8xl rotate-12"></i>
        <i class="fa-solid fa-paw absolute bottom-10 right-10 text-9xl -rotate-12"></i>
    </div>

    {{-- Dogs --}}
    <div class="max-w-5xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
        @foreach($this->dogs as $dog)
            @include('livewire.dog.village.dogs')
        @endforeach
    </div>

    {{-- Separator --}}
    <div class="flex items-center gap-4 py-6 opacity-70">
        <i class="fa-solid fa-paw text-pink-300 animate-pulse"></i>
        <div class="h-px flex-1 bg-pink-100"></div>
        <i class="fa-solid fa-paw text-pink-300 animate-pulse"></i>
        <div class="h-px flex-1 bg-pink-100"></div>
        <i class="fa-solid fa-paw text-pink-300 animate-pulse"></i>
    </div>

</div>
