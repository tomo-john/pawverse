{{-- Random Walk  --}}
<div x-data="{
        x: 0,
        y: 0,
    }"
>

    <div class="h-96 m-6 bg-white rounded-xl shadow border border-gray-700 flex justify-center items-center">
        <div class="relative">
            <div class="absolute" :style="{ left: x + 'px', top: y + 'px'}">
                <i class="fa-solid fa-dog text-sky-300 text-3xl"></i>
            </div>
        </div>
    </div>

</div>
