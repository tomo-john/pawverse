<div wire:key="dog-{{ $dog->id }}"
     @class([
        'relative rounded-2xl bg-white ring-2 p-4 flex flex-col items-center gap-3 transition-all duration-300',
        'ring-gray-200 hover:shadow-2xl hover:-translate-y-1' => $editingId !== $dog->id,
        'ring-blue-400 shadow-xl scale-[1.02]' => $editingId === $dog->id,
     ])

    <!-- Show Link -->
    <a href="{{ route('dog.show', $dog) }}" class="absolute inset-0 z-0"></a>

    <!-- Dog Icon -->
    <div class="flex items-center justify-center h-36">
        <i
            @class([
                "fa-solid fa-dog {$dog->size_class}",
                'animate-bounce' => $dog->id === $editingId,
            ])
            style="color: {{ $dog->color }}"
        >
        </i>

        <!-- 編集中のセリフ -->
        @if ($dog->id === $editingId)
            <div class="relative ml-2 animate-bounce">
                <span class="bg-blue-100 text-blue-600 text-xs px-3 py-1 rounded-full shadow">
                    編集中だわん!
                </span>

                <div class="absolute -left-1 top-1/2 -translate-y-1/2 w-2 h-2 bg-blue-100 rotate-45"></div>
            </div>
        @endif
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
    <div class="flex gap-4 z-10 relative">
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
