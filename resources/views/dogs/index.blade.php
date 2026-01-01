<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            My Dogs 🐶
        </h2>
    </x-slot>
    
    <!-- フラッシュメッセージ -->
    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="p-6">
        <a href="{{ route('dogs.create') }}"
           class="text-blue-500 hover:underline">
            <i class="fa-regular fa-square-plus mr-1"></i>新しい犬を登録
        </a>

        <ul class="mt-4">
            @forelse ($dogs as $dog)
                <li class="max-w-4xl mx-auto border rounded-lg p-4 mb-3 bg-whit shadow-sm flex justify-between items-center">
                    <!-- 左側: 犬情報 -->
                    <div>
                        <!-- name(showへのリンク) -->
                        <a href="{{ route('dogs.show', $dog) }}"
                           class="font-semibold text-lg text-gray-800 hover:text-pink-500">
                            {{ $dog->name }}
                        </a>

                        <!-- size -->
                        <div class="text-sm text-gray-500">
                            {{ $dog->size }}
                            @if ($dog->is_public)
                                <span class="ml-2 text-green-600"><i class="fa-solid fa-palette text-yellow-500 mr-1"></i>公開</span>
                            @else
                                <span class="ml-2 text-gray-400"><i class="fa-solid fa-lock mr-1"></i>非公開</span>
                            @endif
                        </div>
                    </div>

                    <!-- 右側: 操作ボタン -->
                    <div class="flex gap-3 text-sm">
                        @can('update', $dog)
                            <a href="{{ route('dogs.edit', $dog) }}" 
                               class="text-blue-600 hover:underline">
                                編集
                            </a>
                        @endcan

                        @can('delete', $dog)
                            <form action="{{ route('dogs.destroy', $dog) }}" 
                                  method="post"
                                  class="inline"
                                  onclick="return confirm('本当に削除するワン？🐶');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">削除</button>
                            </form>
                        @endcan
                    </div>
                </li>
            @empty
                <li>まだ犬がいません🐕</li>
            @endforelse
        </ul>
    </div>
</x-app-layout>
