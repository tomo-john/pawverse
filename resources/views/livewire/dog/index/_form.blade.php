<div id="dog-form"
     @class([
        'max-w-xl mx-auto border rounded-xl space-y-4 p-4',
        'border-gray-200' => !$editingId,
        'border-blue-400 ring-2 ring-blue-100' => $editingId,
     ])
>

    <div class="text-sm font-medium text-gray-500">
        登録フォーム
        @if ($this->editingId)
            <i class="fa-solid fa-dog mx-1"></i>
            編集中
            <i class="fa-solid fa-dog mx-1"></i>
        @endif
    </div>

    <!-- name -->
    <flux:input id="dog-name" label="Name" wire:model.live="name"/>

    <!-- color -->
    <div class="space-y-1">
        <label class="text-sm font-medium">Color</label>

        <div class="flex items-center gap-3">
            <input type="color"
                   wire:model.live="color"
                   class="h-10 w-10 border rounded p-0">
            <span class="text-sm text-gray-500">
                {{ $color }}
            </span>
        </div>
    </div>

    <!-- size_level-->
    <div class="space-y-1">
        <label class="text-sm font-medium">Size</label>

        <input type="range"
               min="1"
               max="9"
               step="1"
               wire:model.live="size_level"
               class="w-full">

        <div class="text-sm text-gray-500">
            Level: {{ $size_level }}
        </div>
    </div>

    <!-- is_public -->
    <flux:checkbox label="公開する🐶？" wire:model="is_public" />

    <!-- Submit Button-->
    <div class="flex gap-4">
        <flux:button wire:click="save">
            {{ $this->editingId ? '更新' : '保存' }}
        </flux:button>

        <flux:button wire:click="resetForm" variant="ghost">
            キャンセル
        </flux:button>
    </div>

</div>
