<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            ようこそ pawverse へ
            <i class="fa-solid fa-dog"></i>
        </h2>
    </x-slot>

    <div class="space-y-8">
        <!-- あなたの犬たち -->
        <section>
            <h3 class="text-lg font-semibold mb-3">あなたの犬たち</h3>
            <!-- 小さな dog カード一覧 -->
        </section>

        <!-- 今日できること -->
        <section>
            <h3 class="text-lg font-semibold mb-3">できること</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                <a href="{{ route('dogs.index') }}">犬一覧</a>
                <a href="{{ route('dogs.create') }}">新しい犬を迎える</a>
                <a href="#">お世話（準備中）</a>
            </div>
        </section>
    </div>
</x-app-layout>
