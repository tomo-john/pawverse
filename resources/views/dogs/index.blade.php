<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Dogs 🐶
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

        <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @forelse ($dogs as $dog)
                <li class="bg-white rounded-2xl shadow hover:shadow-lg transition p-4">
                
                    <!-- 犬アイコン -->
                    <div class="flex justify-center mb-3">
                        <i class="fa-solid fa-dog
                            {{ $dog->size === 'small' ? 'text-4xl' : ($dog->size === 'large' ? 'text-7xl' : 'text-5xl') }}
                            {{ 'text-gray-500' }}">
                        </i>
                    </div>

                    <!-- 名前 -->
                    <h3 class="text-center font-semibold text-lg">
                        <a href="{{ route('dogs.show', $dog) }}" class="hover:text-pink-500">{{ $dog->name }}</a>
                    </h3>

                    <!-- メタ情報 -->
                    <div class="mt-2 text-center text-sm text-gray-500 flex justify-center gap-2">
                        <span>{{ $sizes[$dog->size] }}</span>

                        @if ($dog->is_public)
                            <span class="text-green-600 bg-green-100 px-2 rounded-full text-xs">公開</span>
                        @else
                            <span class="text-gray-400 bg-gray-100 px-2 rounded-full text-xs">非公開</span>
                        @endif
                    </div>

                    <!-- 操作 -->
                    <div class="mt-4 flex justify-center gap-2 text-sm">
                        @can('update', $dog)
                            <a href="{{ route('dogs.edit', $dog) }}"
                               class="px-3 py-1 bg-blue-500 text-white rounded-full">
                                編集
                            </a>
                        @endcan

                        @can('delete', $dog)
                            <form action="{{ route('dogs.destroy', $dog) }}"
                                  method="POST"
                                  onsubmit="return confirm('本当に削除するワン？🐶');">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 bg-red-500 text-white rounded-full">
                                    削除
                                </button>
                            </form>
                        @endcan
                    </div>
                </li>
            @empty
                <p>まだ犬がいません🐕</p>
            @endforelse
        </ul>
    </div>
</x-app-layout>
