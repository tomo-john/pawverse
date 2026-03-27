<div class="p-6 m-6 bg-white rounded-xl shadow border border-gray-100"
     x-data="{ colorClass: 'text-gray-400' }"
>

    <div class="text-center space-y-4">
        {{-- ワンコのアイコン --}}
        <div class="text-5xl">
            <i class="fa-solid fa-dog transition-colors duration-500" :class="colorClass"></i>
        </div>

        {{-- ボタン --}}
        <div class="flex justify-center gap-2">

            <button @click="colorClass = 'text-red-600'"
                    class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-xs font-red"
            >
                赤色
            </button>

            <button @click="colorClass = 'text-blue-600'"
                    class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-blue"
            >
                青色
            </button>

            <button @click="colorClass = 'text-green-600'"
                    class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-xs font-green"
            >
                緑色
            </button>

            <button @click="colorClass = 'text-yellow-600'"
                    class="px-3 py-1 bg-yellow-100 text-yellow-600 rounded-full text-xs font-yellow"
            >
                黄色
            </button>

            <button @click="colorClass = 'text-gray-600'"
                    class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-gray"
            >
                リセット
            </button>

        </div>


    </div>
</div>
