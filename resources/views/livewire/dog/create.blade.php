<div x-data="createDog()" class="max-w-3xl mx-auto flex flex-col gap-6">

    {{-- Preview --}}
    <div class="relative flex flex-col items-center gap-2 h-84 border">
        <i class="fa-solid fa-house text-9xl text-pink-400"></i>
        <i class="fa-solid fa-dog text-9xl text-pink-400"></i>
    </div>

    {{-- Console Message --}}
    <div class="w-full bg-gray-100/80 border-4 border-gray-400 p-4 rounded-lg shadow-inner mt-6"
         x-transition.opacity.duration.500ms
    >
        <div class="flex items-center gap-3 animate-pulse">
            <i class="fa-solid fa-circle-question text-gray-400"></i>
            <p class="text-gray-500 font-bold text-sm">{{ $this->consoleMessage }}</p>
        </div>
    </div>

    {{-- Form --}}
    @if($step === 1)
        <div class="max-w-full mx-auto">
            <input wire:model.live="name"
                   class="w-full px-2 py-2 rounded-2xl bg-pink-50/50 border-2 border-pink-100 focus:border-pink-400 focus:ring-2 focus:ring-pink-200 outline-none transition"
            >
        </div>
    @endif

    {{-- 進行ボタン --}}
    <div class="flex items-center justify-center gap-4 text-2xl">
        @if($step === 0)
            <button wire:click="nextStep" class="cursor-pointer text-gray-400 flex items-center gap-2 hover:animate-pulse">
                <span class="text-sm">はじめる</span>
            </button>
        @endif

        @if($step >= 2)
            <button wire:click="prevStep" class="cursor-pointer"><i class="fa-regular fa-circle-left"></i></button>
        @endif

        @if($step >= 1)
            <button wire:click="nextStep" class="cursor-pointer"><i class="fa-regular fa-circle-right"></i></button>
        @endif
    </div>

    {{-- Debug --}}
    <div class="flex flex-col gap-2  text-sm bg-slate-200 text-slate-500 rounded-2xl mt-10 p-2">
        <p class="text-pink-400 font-bold">Debug Area</p>
        <p>step: {{ $step }}</p>
        <p>{{ $name ? $name : '名無しのわんこ' }}</p>
    </div>

</div>

<script>
    function creatDog() {
        return {

        }
    }
</script>
