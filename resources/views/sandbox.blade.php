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

            <!-- Alpine.js 実験 -->
            <div x-data=" { count:0 }"
                 class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition flex flex-col items-center gap-4">

                <h3 class="font-bold mb-2">Counter Dog(Alpine.js)<h3>

                <div class="text-4xl">
                    <i class="fa-solid fa-dog"></i>
                    <span x-text="count"></span>
                </div>

                <button @click="count++"
                        class="px-4 py-2 mt-4 bg-pink-500 hover:bg-pink-600 text-white rounded-full transition">
                    ぽち！
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
