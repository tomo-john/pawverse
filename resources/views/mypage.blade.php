<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            ようこそ、{{ auth()->user()->name }}さん 🐶
        </h2>
    </x-slot>

    <div class="space-y-10">

        <!-- あなたの犬たち -->
        <section>
            <h3 class="text-lg font-semibold mb-4">
                あなたの犬たち
            </h3>

            @if ($dogs->isEmpty())
                <p class="text-gray-500">
                    まだ犬がいません 🐾
                </p>

                <a href="{{ route('dogs.create') }}"
                   class="inline-block mt-3 px-5 py-2 bg-pink-500 text-white rounded-lg">
                    犬を迎える
                </a>
            @else
                <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($dogs as $dog)
                        <li class="bg-white rounded-xl shadow p-4">
                            <div class="text-4xl text-center mb-2">
                                <i class="fa-solid fa-dog"></i>
                            </div>

                            <p class="text-center font-semibold">
                                {{ $dog->name }}
                            </p>

                            <div class="text-center text-sm text-gray-500 mt-1">
                                {{ \App\Models\Dog::sizes()[$dog->size] }}
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>

        <!-- ナビゲーション -->
        <section>
            <h3 class="text-lg font-semibold mb-4">
                できること
            </h3>

            <div class="flex gap-4 flex-wrap">
                <a href="{{ route('dogs.index') }}"
                   class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200">
                    犬一覧
                </a>

                <a href="{{ route('dogs.create') }}"
                   class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200">
                    新しい犬を迎える
                </a>

                <span class="px-4 py-2 rounded-lg bg-gray-50 text-gray-400">
                    お世話（準備中）
                </span>
            </div>
        </section>

    </div>
</x-app-layout>
