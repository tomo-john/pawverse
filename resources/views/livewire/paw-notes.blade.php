<div class="max-w-xl mx-auto space-y-6">
    <div class="bg-white rounded-xl shadow p-4 space-y-3">
        <h2 class="font-semibold text-lg">
            <i class="fa-solid fa-paw"></i>
            Paw Note
        </h2>
        <flux:textarea
            wire:model.defer="body"
            variant="default"
            label="Paw Note"
            rows="3"
            placeholder="ひとことメモを書くワン..."
        />

        <flux:button wire:click="save">SAVE</flux:button>
    </div>
</div>
