@php
    $dogColorClasses = [
        'white'  => 'text-white drop-shadow',
        'black'  => 'text-black',
        'gray'   => 'text-gray-500',
        'brown'  => 'text-amber-800',
        'gold'   => 'text-yellow-500',
        'red'    => 'text-red-500',
        'blue'   => 'text-blue-500',
        'pink'   => 'text-pink-500',
        'violet' => 'text-violet-500',
    ];
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Dogs 🐶
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="m-6 p-3 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="p-6 space-y-6">

        <!-- 新規作成 -->
        <div>
            <a href="{{ route('dogs.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2
                      bg-pink-500 text-white rounded-lg
                      hover:bg-pink-600 transition">
                <i class="fa-regular fa-square-plus"></i>
                新しい犬を迎える
                <i class="fa-solid fa-dog"></i>
            </a>
        </div>

        <!-- 一覧 -->
        <div class="bg-white rounded-2xl shadow overflow-hidden">
            <ul class="divide-y">
                @forelse ($dogs as $dog)
                    <li class="flex items-center justify-between px-8 py-4
                               hover:bg-gray-50 transition">

                        <!-- 左: 犬アイコン + 基本情報 -->
                        <div class="flex items-center gap-4">
                            <div class="w-10 flex justify-center">
                                <a href="{{ route('dogs.show', $dog) }}"
                                    <i class="fa-solid fa-dog text-3xl {{ $dogColorClasses[$dog->color] ?? 'text-gray-400' }}"></i>
                                </a>
                            </div>

                            <div class="space-y-1">
                                <a href="{{ route('dogs.show', $dog) }}"
                                   class="font-semibold text-gray-800 hover:text-pink-500">
                                    {{ $dog->name }}
                                </a>

                                <div class="text-sm text-gray-500 flex gap-2 items-center">
                                    <span>{{ $sizes[$dog->size] }}</span>

                                    @if ($dog->is_public)
                                        <span class="text-green-600 bg-green-100 px-2 rounded-full text-xs">
                                            公開
                                        </span>
                                    @else
                                        <span class="text-gray-400 bg-gray-100 px-2 rounded-full text-xs">
                                            非公開
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- 右: 操作 -->
                        <div class="flex gap-2 text-sm">
                            @can('update', $dog)
                                <a href="{{ route('dogs.edit', $dog) }}"
                                   class="px-3 py-1 rounded-full
                                          bg-blue-100 text-blue-700
                                          hover:bg-blue-200 transition">
                                    編集
                                </a>
                            @endcan

                            @can('delete', $dog)
                                <form action="{{ route('dogs.destroy', $dog) }}"
                                      method="POST"
                                      onsubmit="return confirm('本当に削除するワン？🐶');">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="px-3 py-1 rounded-full
                                               bg-red-100 text-red-700
                                               hover:bg-red-200 transition">
                                        削除
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </li>
                @empty
                    <li class="p-6 text-gray-500">
                        まだ犬がいません 🐾
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</x-app-layout>
