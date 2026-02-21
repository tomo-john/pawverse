<div class="max-w-5xl mx-auto space-y-4">

    <flux:heading size="xl">
        <i class="fa-solid fa-paw"></i>
        Public Dogs
    </flux:heading>

    {{-- リアルタイムフィルタ --}}
    <div class="my-4">
        <flux:input wire:model.live.debounce.500ms="search" icon="magnifying-glass" placeholder="名前 or 飼い主名で検索..."/>
    </div>
    <div wire:loading.delay wire:target="search" class="text-sm text-gray-400">
        検索中...
        <i class="fa-solid fa-dog fa-spin"></i>
    </div>

    {{-- ページネーション --}}
    <div class="my-4">
        {{ $dogs->links() }}
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse ($dogs as $dog)
            <div class="flex flex-col justify-center items-center rounded-2xl bg-white p-4 shadow">
                <div class="flex justify-center items-center h-36">
                <i class="fa-solid fa-dog {{ $dog->size_class }}"
                   style="color: {{ $dog->color }}"></i>
                </div>

                <div class="mt-2 text-sm font-medium text-gray-800">
                    {{ $dog->name }}
                </div>

                <div class="text-xs text-gray-500">
                    {{ '(飼い主: ' . $dog->user->name . ')'}}
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center">
                <p class="text-gray-500">
                    {{$this->search
                        ? '見つかりませんでした🐾'
                        : 'まだ公開されているわんこはいません🐾'
                    }}
                </p>
            </div>
        @endforelse
    </div>
</div>
