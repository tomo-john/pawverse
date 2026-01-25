<div class="max-w-xl mx-auto space-y-6">
    <div class="max-w-xl mx-auto p-4 flex justify-center items-center">
        <div class="relative">
            <i class="fa-solid fa-dog text-5xl text-black"></i>

            @if ($saved)
                <div
                    x-data="{ show: false}"
                    x-on:paw-saved.window="show = true; setTimeout(() => show = false, 2500);"
                    x-show="show"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95 translate-x-0"
                    x-transition:enter-end="opacity-100 scale-100 translate-x-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute left-full top-1/2 -translate-y-1/2 bg-green-400 text-sm text-white border border-green-500 rounded-xl ml-3 p-3">

                    <span class="flex items-center whitespace-nowrap">
                        保存しました<i class="fa-solid fa-paw ml-2"></i>
                    </span>
                </div>
            @endif
        </div>

    </div>
    <div class="bg-amber-800 rounded-xl shadow p-4 space-y-3">
        <h2 class="font-semibold text-lg">
            <i class="fa-solid fa-paw"></i>
            Paw Note
        </h2>
        <flux:textarea
            wire:model.defer="body"
            variant="outlined"
            label="Paw Note"
            rows="3"
            placeholder="ひとことメモを書くワン..."
        />

        <flux:button wire:click="save">SAVE</flux:button>
    </div>
</div>
