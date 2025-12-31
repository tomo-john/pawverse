<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center text-center gap-6">
        
        <h1 class="text-4xl font-extrabold">
            pawverse 🐶
        </h1>

        <p class="text-gray-600 max-w-md">
            あなただけの犬たちと暮らす、小さな世界。<br>
            作って、育てて、いつか共有する。
        </p>

        <div class="flex gap-4 mt-4">
            <a href="{{ route('register') }}"
               class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                はじめる
            </a>

            <a href="{{ route('login') }}"
               class="px-6 py-3 border rounded-lg hover:bg-gray-100">
                ログイン
            </a>
        </div>

    </div>
</x-guest-layout>
