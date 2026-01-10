<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center px-6 text-center gap-10">

        <!-- タイトル -->
        <div class="space-y-3">
            <h1 class="text-5xl font-extrabold tracking-tight">
                pawverse
            </h1>

            <p class="text-gray-600 max-w-md leading-relaxed">
                <i class="fa-solid fa-dog"></i>
                paswverse In Development
                <i class="fa-solid fa-dog"></i>
            </p>
        </div>

        <!-- 犬アイコンたち -->
        <div class="flex gap-6 text-5xl text-gray-400">
            <i class="fa-solid fa-dog"></i>
            <i class="fa-solid fa-dog -scale-x-100"></i>
            <i class="fa-solid fa-dog"></i>
        </div>

        <!-- できること -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-3xl w-full">
            <div class="bg-white rounded-2xl shadow p-6">
            </div>

            <div class="bg-white rounded-2xl shadow p-6">
            </div>

            <div class="bg-white rounded-2xl shadow p-6">
            </div>
        </div>

        <!-- CTA -->
        <div class="flex gap-4 mt-6">
            <a href="{{ route('register') }}"
               class="px-8 py-3 bg-pink-500 text-white rounded-xl hover:bg-pink-600 transition">
                はじめる 🐾
            </a>

            <a href="{{ route('login') }}"
               class="px-8 py-3 border rounded-xl hover:bg-gray-100 transition">
                ログイン
            </a>
        </div>

    </div>
</x-guest-layout>
