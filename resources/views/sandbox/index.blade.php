<x-layouts.guest>

    <div class="max-w-5xl mx-auto">

        {{-- Header --}}
        <div class="p-6 m-6 bg-white rounded-xl shadow border border-gray-100">
            <div class="flex justify-center items-center gap-2">
                <i class="fa-solid fa-dog text-5xl text-pink-500"></i>
                <span class="text-sm text-pink-600">SandBoxへようこそ</span>
            </div>
        </div>

        {{-- Menu --}}
        <div class="flex gap-3 m-6">
            <a href="{{ route('sandbox.page', 'alpine') }}"
               class="inline-block px-6 py-3 bg-pink-600 hover:bg-pink-700 text-white font-semibold rounded-lg shadow-md transition duration-300"
            >
                Alpine
            </a>
        </div>

        {{-- Run Dog  --}}
        <div class="m-6 bg-gray-600 rounded-xl shadow border border-gray-700 relative overflow-hidden flex justify-center items-center"
             x-data="{
                posX: 50,
                posY: 50,
                speed: 1.5,

             }"
             x-init="
             "
             style="height: 400px;"
        >
            <div class="absolute text-center transition-transform duration-100 ease-linear">
                <i class="fa-solid fa-dog text-5xl text-pink dog-walk"
                ></i>
            </div>
        </div>

    </div>

</x-layouts.guest>
