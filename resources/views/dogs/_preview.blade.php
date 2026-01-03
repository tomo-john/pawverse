<div class="w-[256px] h-[256px] border bg-gray-200 mx-auto m-8 shadow-inner rounded-lg overflow-hidden">
    <div class="h-full flex flex-col p-4">
        <p class="text-xs text-gray-400 font-mono font-bold text-center italic">
            preview_dog
        </p>

        <div class="flex-grow flex items-center justify-center">
            <i class="fa-solid fa-dog transition-all duration-700"
               :class="[ sizeClass(), colorClass() ]">
            </i>
        </div>

        <p class="text-md font-mono font-semibold text-center border-t border-dashed pt-2"
           x-text="name || 'no name'">
        </p>
    </div>
</div>
