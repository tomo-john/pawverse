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
            Tailwind実験用エリア
        </div>

        <div class="bg-white p-4 rounded shadow">
            JSで犬を動かす予定の場所🐕💨
        </div>
    </div>

    <div class="w-6xl min-h-screen flex justify-center items-center bg-white border p-2 m-4">
        <div id="dog"
             class="text-6xl cursor-pointer transition transform">
          <i class="fa-solid fa-dog"></i>
        </div>
    </div>
    <div class="hidden scale-125 translate-x-[700px]"></div>
</x-app-layout>
