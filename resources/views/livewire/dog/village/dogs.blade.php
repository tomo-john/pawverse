<div wire:key="dog-{{ $dog->id }}" class="relative">
    {{-- Dog --}}
    <div class="relative flex flex-col items-center justify-center h-64 w-64 border">
        <i class="fa-solid fa-dog {{ $dog->size_class }}
                  transition-all duration-500
                  hover:scale-110 hover:-rotate-3"
           style="color: {{ $dog->color }}"></i>
    </div>
</div>
