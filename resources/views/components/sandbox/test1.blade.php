<div class="p-6 m-6 bg-white rounded-xl shadow border border-gray-100"
     x-data="{ show: false }"
>

    <div class="text-center space-y-4">
        {{-- ワンコのアイコン --}}
        <div class="text-5xl text-red-500">
            <i class="fa-solid fa-dog"></i>
        </div>

        {{-- ワンコの名前（ここを出し入れしたい！） --}}
        <div x-show="show" class="text-xl font-bold text-red-600">
            じょん
        </div>

        {{-- 切り替えボタン --}}
        <button @click="show = !show"
                class="px-4 py-2 bg-red-400 text-white rounded-lg text-sm">
            ぽちっ🐶
        </button>

    </div>

</div>
