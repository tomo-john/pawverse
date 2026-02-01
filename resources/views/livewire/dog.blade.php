<div class="max-w-5xl mx-auto space-y-4">

    <flux:header>Dogs</flux:header>

    <!-- フォーム -->
    <div class="max-w-xl mx-auto border rounded-xl space-y-4 p-4">
        <div>登録フォーム</div>

        <!-- name -->
        <flux:input label="Name" wire:model.live.debounce.500ms="name"/>

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

        <!-- met_at-->
        <flux:input label="When did you first meet ?" type="date" wire:model="met_at"/>

        <!-- is_good_boy-->
        <flux:checkbox label="is_good_boy?🐶" wire:model.live="is_good_boy"></flux:checkbox>

        <!-- Submit Button-->
        <flux:button wire:click="save">保存</flux:button>
    </div>

    <!-- プレビュー -->
    <div class="max-w-xl mx-auto border h-[256px] rounded-xl flex flex-col justify-center items-center gap-4">
        <div class="text-xl text-gray-300 mt-4">
            {{ $name ? $name : 'no name' }}
        </div>

        <div class="flex flex-1 justify-center items-center">
            <i class="fa-solid fa-dog {{ $this->sizeClass }}"
               style="color: {{ $color }}">
            </i>
        </div>

        <div class="text-sm text-gray-400 mb-4">
            {{ $this->goodBoyLabel }}
        </div>
    </div>
</div>
