<div class="max-w-xl mx-auto space-y-6">
    <div class="max-w-xl mx-auto border p-4 flex justify-center items-center">
        <div class="relative">
            <i class="fa-solid fa-dog text-5xl text-black"></i>

            @if ($saved)
                <div class="absolute left-full top-1/2 ^translate-y-1/2 ml-3">
                    <span class="text-black whitespace-nowrap">保存しました<i class="fa-solid fa-paw"></i></span>
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
