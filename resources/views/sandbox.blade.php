<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-pink-500">
            <span class="px-2 inline-block"><i class="fa-solid fa-dog"></i></span>
            pawverse sandbox
            <span class="px-2 inline-block"><i class="fa-solid fa-dog"></i></span>
        </h2>
    </x-slot>

    <div class="p-6 space-y-4">
        <div class="bg-white p-4 rounded shadow">
            Tailwind・JS・Component 実験場
        </div>

        <!-- Alpine sandboxUi -->
        <div x-data="sandboxUi()">
            <div class="flex flex-col items-center gap-6">

                <!-- dog icon -->
                <div class="h-[256px] w-[256px] flex justify-center items-center bg-gray-200 border rounded-full">
                    <i
                        class="fa-solid fa-dog"
                        :class="[sizeClass(), colorClass()]">
                    </i>
                </div>

                <!-- namea -->
                <div class="text-lg font-semibold">
                    <span x-text="name"></span>
                </div>

                <!-- input -->
                <div class="flex">
                    <input type="text" x-model="name" placeholder="名前を入力">

                    <select x-model="size">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                    </select>

                    <select x-model="color">
                      <option value="white">white</option>
                      <option value="black">black</option>
                    </select>
                </div>

                <!-- state -->
                <div class="border rounded-xl m-4 p-4">
                    <span class="text-sm text-blue-500">state</span>
                    <pre x-text="JSON.stringify({ name, size, color }, null, 2)"></pre>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
