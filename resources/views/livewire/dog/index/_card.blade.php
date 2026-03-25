<div wire:key="dog-{{ $dog->id }}"
     class="relative rounded-2xl bg-white ring-1 ring-gray-200 p-4
            flex flex-col items-center gap-3
            hover:shadow-2xl hover:-translate-y-1
            transition-all duration-300">

    <!-- show -->
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
