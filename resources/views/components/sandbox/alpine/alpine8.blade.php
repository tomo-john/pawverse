{{-- Random Walk  --}}
<div x-data="{
        dogs: ['じょん']
    }"
>

    <div class="m-6 bg-white rounded-xl shadow border border-gray-700 flex flex-col items-center gap-3">
        <div class="mt-3">
            <button class="bg-pink-500 rounded-lg px-2 py-1 cursor-pointer" @click="dogs.push('じょん')">分身</button>
        </div>

        <div class="flex flex-wrap gap-4">
            <template x-for="dog in dogs">
                <div class="flex flex-col items-center">
                    <i class="fa-solid fa-dog text-black text-3xl"></i>
                    <span class="text-xs text-gray-400" x-text="dog"></span>
                </div>
            </template>
        </div>
    </div>

</div>
