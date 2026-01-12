<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            ようこそ、{{ auth()->user()->name }}さん 🐶
        </h2>
    </x-slot>

    <div class="m-4 space-y-10">

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
                    <i class="fa-regular fa-square-plus"></i>
                    新しい犬を迎える
                    <i class="fa-solid fa-dog"></i>
                </a>
            @else
                <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($dogs as $dog)
                        <li
                            x-data="dogUi({
                                name: '{{ $dog->name }}',
                                color: '{{ $dog->color }}',
                                size: '{{ $dog->size }}',
                            })"
                            class="relative bg-gray-200 rounded-2xl shadow p-5 space-y-4
                                   hover:shadow-lg transition"
                        >

                            <!-- 名前 -->
                            <div class="text-center">
                                <h4 class="text-lg font-semibold">
                                    {{ $dog->name }}
                                </h4>
                            </div>

                            <!-- 犬アイコン -->
                            <div class="flex justify-center">
                               <div
                                    @mouseenter="isHoverd = true"
                                    @mouseleave="isHoverd = false"
                                    class="transition transform hover:scale-110"
                                    :class="[
                                        sizeClass(),
                                        colorClass(),
                                        isHoverd ? 'rotate-6 scale-110' : ''
                                    ]"
                                >
                                    <i class="fa-solid fa-dog"></i>
                                </div>
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
                <span class="px-4 py-2 rounded-lg bg-gray-50 text-gray-400">
                    お世話（準備中）
                </span>
            </div>
        </section>

    </div>
</x-app-layout>
