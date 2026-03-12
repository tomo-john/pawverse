<div class="max-w-5xl mx-auto space-y-4">

    <flux:heading size="xl">
        <i class="fa-solid fa-paw"></i>
        Pawverse Dog
    </flux:heading>

    <x-dog.toast />

    <div class="max-w-5xl mx-auto space-y-6">
        <!-- フォーム -->
        <div class="max-w-xl mx-auto border rounded-xl space-y-4 p-4">
            <div class="text-sm font-medium text-gray-500">
                登録フォーム
                @if ($this->editingId)
                    <i class="fa-solid fa-dog mx-1"></i>
                    編集中
                    <i class="fa-solid fa-dog mx-1"></i>
                @endif
            </div>

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

        <!-- プレビュー -->
        <div class="w-[300px] h-[300px] mx-auto rounded-full
                    border border-gray-200 ring-1 ring-gray-200
                    flex flex-col justify-center items-center px-6 py-5
                    transition-color duration-500"
             style="background-color: {{ $color }}15;"
        >
            <div class="text-xs tracking-wide text-gray-400">
                Dog Preview
            </div>

            <div class="text-sm text-gray-500 my-2">
                {{ $name ? $name : 'no name' }}
            </div>

            <div class="flex flex-1 justify-center items-center">
                <i class="fa-solid fa-dog {{ $this->sizeClass }} drop-shadow-sm transition-all duration-500"
                   style="color: {{ $color }}"></i>
            </div>

        </div>
    </div>

    <flux:separator variant="subtle" class="my-6" />

    <!-- Index -->
    <flux:heading size="md">
        <i class="fa-solid fa-dog mx-1"></i>
        Your Dogs
        <i class="fa-solid fa-dog mx-1"></i>
    </flux:heading>

    <div class="max-w-5xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse($this->dogs as $dog)
            <div wire:key="dog-{{ $dog->id }}"
                 class="relative rounded-2xl bg-white ring-1 ring-gray-200 p-4
                        flex flex-col items-center gap-3
                        hover:shadow-2xl hover:-translate-y-1
                        transition-all duration-300">

                <a href="{{ route('dog.show', $dog) }}" class="absolute inset-0 z-0"></a>

                <!-- Dog Icon -->
                <div class="flex items-center justify-center h-36">
                    <i class="fa-solid fa-dog {{ $dog->size_class }}"
                       style="color: {{ $dog->color }}"></i>
                </div>

                <!-- Public Badge -->
                <div class="absolute top-2 right-2 z-10">
                    <span class="{{ $dog->public_visibility['class'] }} text-xs rounded-full px-2 py-1">
                        {{ $dog->public_visibility['label'] }}
                    </span>
                </div>

                <!-- Name -->
                <div class="text-sm font-medium text-gray-800">
                    {{ $dog->name }}
                </div>

                <!-- アクション -->
                <div class="flex gap-4 z-10">
                    @can('update', $dog)
                        <button wire:click="edit({{ $dog->id }})">
                            <i class="fa-regular fa-pen-to-square text-blue-300 hover:text-blue-400 cursor-pointer"></i>
                        </button>
                    @endcan

                    @can('delete', $dog)
                        <button wire:click="delete({{ $dog->id }})" wire:confirm="お別れしてよろしいですか？🐶">
                            <i class="fa-solid fa-circle-minus text-red-300 hover:text-red-400 cursor-pointer"></i>
                        </button>
                    @endcan
                </div>
            </div>
        @empty
            <p class="text-gray-500">まだ登録されたわんちゃんはいません 🐾</p>
        @endforelse
    </div>

</div>
