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
            <div x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
                <i class="fa-solid fa-dog transition-transform duration-300"
                   :class="hover ? 'rotate-6' : ''"></i>
            </div>
            <div x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
                <i class="fa-solid fa-dog transition-transform duration-300"
                   :class="hover ? 'scale-110' : ''"></i>
            </div>
            <div x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
                <i class="fa-solid fa-dog transition-transform duration-300"
                   :class="hover ? '-translate-y-1' : ''"></i>
            </div>
            <div x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
                <i class="fa-solid fa-dog transition-transform duration-300"
                   :class="hover ? 'opacity-75' : ''"></i>
            </div>
        </div>

        <!-- CTA -->
        <div class="flex flex-col gap-4 mt-6">
            <a href="{{ route('register') }}"
               class="px-8 py-3 bg-pink-500 text-white rounded-xl hover:bg-pink-600 transition">
                はじめる 🐾
            </a>

            <a href="{{ route('login') }}"
               class="px-8 py-3 border rounded-xl hover:bg-gray-100 transition">
                ログイン
            </a>
        </div>

        <!-- 犬アイコンたち -->
        <div class="flex gap-6 text-5xl text-gray-400">
            <div x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
                <i class="fa-solid fa-dog transition-transform duration-300"
                   :class="hover ? 'rotate-180' : ''"></i>
            </div>
            <div x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
                <i class="fa-solid fa-dog transition-transform duration-300"
                   :class="hover ? 'scale-90' : ''"></i>
            </div>
            <div x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
                <i class="fa-solid fa-dog transition-transform duration-300"
                   :class="hover ? '-scale-x-100' : ''"></i>
            </div>
            <div x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
                <i class="fa-solid fa-dog transition-transform duration-300"
                   :class="hover ? 'translate-x-10' : ''"></i>
            </div>
        </div>

    </div>
</x-guest-layout>
