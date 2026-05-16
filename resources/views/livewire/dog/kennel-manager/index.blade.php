<div class="max-w-5xl mx-auto space-y-10 relative">

    {{-- Background --}}
    <div class="absolute inset-0 pointer-events-none opacity-[0.04]">
        <i class="fa-solid fa-paw absolute top-10 -left-10 text-8xl rotate-12"></i>
        <i class="fa-solid fa-paw absolute bottom-10 right-10 text-9xl -rotate-12"></i>
    </div>

    {{-- Dogs --}}
    @include('livewire.dog.kennel-manager.dogs')

    {{-- Separator --}}
    <div class="flex items-center gap-4 py-6 opacity-70">
        <i class="fa-solid fa-paw text-pink-300 animate-pulse"></i>
        <div class="h-px flex-1 bg-pink-100"></div>
        <i class="fa-solid fa-paw text-pink-300 animate-pulse"></i>
        <div class="h-px flex-1 bg-pink-100"></div>
        <i class="fa-solid fa-paw text-pink-300 animate-pulse"></i>
    </div>

    {{-- Form & Prevview--}}
    <div class="relative z-10 p-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center">

            {{-- Form --}}
            <div class="lg:col-span-2"
                 x-data
                 x-on:scroll-to-form.window="
                    setTimeout(() => {
                        const form = document.getElementById('dog-form');
                        const input = document.getElementById('dog-name');

                        form?.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });

                        input?.focus();

                    }, 100)
                 "
            >
                @include('livewire.dog.kennel-manager.form')
            </div>

            {{-- Preview --}}
            <div class="lg:col-span-1">
                @include('livewire.dog.kennel-manager.preview')
            </div>
        </div>
    </div>

    {{-- Toast --}}
    <x-dog.toast />

</div>
