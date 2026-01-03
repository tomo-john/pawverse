<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-pink-500">
            <span class="px-2 inline-block"><i class="fa-solid fa-dog"></i></span>
            pawverse sandbox
            <span class="px-2 inline-block transition transform duration-1000 cursor-pointer" id="right-dog"><i class="fa-solid fa-dog"></i></span>
        </h2>
    </x-slot>

    <div class="p-6 space-y-4">
        <div class="bg-white p-4 rounded shadow">
            Tailwind実験用エリア🐕💨
        </div>
    </div>

    <div class="p-6">
        <!-- Gridでカードを並べる -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Simple JavaScript-->
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="text-center font-bold mb-2">Scale Dog(Simple JS)</h3>
                <div id="dog"
                     class="text-6xl text-center py-4 cursor-pointer transition transform">
                  <i class="fa-solid fa-dog"></i>
                </div>
                <p class="text-sm text-gray-500 text-center">クリックで大きくなるテスト</p>
            </div>
            <div class="hidden scale-125 translate-x-[700px]"></div>

            <!-- Alpine.js (カウンタ) -->
            <div x-data="{ count: 0 }"
                 class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition flex flex-col items-center gap-4">

                <h3 class="font-bold mb-2">Counter<h3>

                <div class="text-4xl">
                    <i class="fa-solid fa-dog"></i>
                    <span x-text="count"></span>
                </div>

                <button @click="count++"
                        class="px-4 py-2 mt-4 bg-pink-500 hover:bg-pink-600 text-white rounded-full transition">
                    ぽち！
                </button>
            </div>

            <!-- Alpine.js (表示・非表示) -->
            <div x-data="{ open: false }"
                 class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition flex flex-col items-center gap-4">

                <h3 class="font-bold mb-2">Open / Close<h3>

                <button @click="open = !open"
                        class="bg-blue-500 text-white px-4 py-2 rounded-full">
                    開くわん
                </button>

                <div x-show="open"
                     x-transition
                     class="mt-3 text-gray-700">
                    表示された🐶
                </div>
            </div>

            <!-- 大きさを変える -->
            <div x-data="{ big: false }"
                 class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="text-center font-bold mb-2">Scale Dog(Alpine.js)</h3>
                <div class="text-6xl text-center py-4">
                    <i class="fa-solid fa-dog cursor-pointer transition transform"
                       @click="big = !big"
                       :class="big ? 'scale-125 text-pink-500' : 'scale-100'">
                    </i>
                </div>
                <p class="text-sm text-gray-500 text-center">Alpine.jsで大きくする</p>
            </div>

            <!-- ふるえる -->
            <div x-data="{ isHungry: false }"
                 class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="text-center font-bold mb-2">Shake Dog</h3>
                <div class="text-6xl text-center py-4">
                    <i class="fa-solid fa-dog cursor-pointer transition transform"
                       @click="isHungry = !isHungry"
                       :class="isHungry ? 'animate-bounce' : ''">
                    </i>
                </div>
                <p x-show="isHungry" class="text-sm text-gray-500 text-center">お腹すいたわん🐶</p>
            </div>

            <!-- 移動する -->
            <div x-data="{ isActive: false }"
                 class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="text-center font-bold mb-2">Run Dog(Apline.js)</h3>
                <div class="text-6xl text-center py-4">
                    <i class="fa-solid fa-dog cursor-pointer transition-transform duration-500 ease-in-out"
                       @click="isActive = !isActive"
                       :class="isActive ? 'translate-x-[100px] text-red-500' : ''">
                    </i>
                </div>
                <p x-show="isActive" class="text-sm text-gray-500 text-center">GO!🐶</p>
            </div>
        </div>
    </div>
</x-app-layout>
