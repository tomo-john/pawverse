<x-app-layout>
    <div class="min-h-[60vh] flex flex-col items-center justify-center gap-4 text-center">

        <div class="text-6xl text-red-500 mt-6">
            <i class="fa-solid fa-ban"></i>
            <i class="fa-solid fa-dog"></i>
        </div>

        <h1 class="text-2xl font-semibold">
            ここには入れないワン…
        </h1>

        <p class="text-gray-500">
            このページは管理者専用です
        </p>

        <a href="{{ route('dashboard') }}"
           class="mt-4 px-4 py-2 bg-pink-500 text-white rounded-lg">
            ダッシュボードへ戻る
        </a>

    </div>
</x-app-layout>
