@php
    $dogColorClasses = [
        'white' => 'text-white drop-shadow',
        'black' => 'text-black',
        'gray'  => 'text-gray-500',
        'brown' => 'text-amber-800',
        'gold'  => 'text-yellow-500',
    ];
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Dog Profile 🐶
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="max-w-3xl mx-auto space-y-6">

            <!-- 上: 名前 & アイコン -->
            <div class="flex flex-col items-center gap-2">
                <i class="fa-solid fa-dog text-6xl
                   {{ $dogColorClasses[$dog->color] ?? 'text-gray-400' }}"></i>

                <h1 class="text-2xl font-bold">
                    {{ $dog->name }}
                </h1>

                @if ($dog->is_public)
                    <span class="text-sm px-3 py-1 rounded-full
                                 bg-green-100 text-green-700">
                        公開中 🐾
                    </span>
                @else
                    <span class="text-sm px-3 py-1 rounded-full
                                 bg-gray-100 text-gray-500">
                        非公開 🔒
                    </span>
                @endif
            </div>

            <!-- 中央: プロフィール -->
            <div class="bg-white rounded-2xl shadow p-6 space-y-4">

                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-palette text-yellow-500 text-xl"></i>
                    <span class="text-gray-600">毛色</span>
                    <span class="ml-auto font-semibold">
                        {{ $colors[$dog->color] ?? $dog->color }}
                    </span>
                </div>

                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-weight-scale text-blue-500 text-xl"></i>
                    <span class="text-gray-600">サイズ</span>
                    <span class="ml-auto font-semibold">
                        {{ $sizes[$dog->size] }}
                    </span>
                </div>

            </div>

            <!-- 下: 操作 -->
            <div class="flex justify-center gap-4">

                @can('update', $dog)
                    <a href="{{ route('dogs.edit', $dog) }}"
                       class="px-5 py-2 rounded-full
                              bg-blue-500 text-white
                              hover:bg-blue-600 transition">
                        編集する
                    </a>
                @endcan

                <a href="{{ route('dogs.index') }}"
                   class="px-5 py-2 rounded-full
                          bg-gray-100 text-gray-700
                          hover:bg-gray-200 transition">
                    一覧へ戻る
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
