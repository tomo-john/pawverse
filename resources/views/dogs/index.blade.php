<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            My Dogs 🐶
        </h2>
    </x-slot>

    <div class="p-6">
        <a href="{{ route('dogs.create') }}"
           class="text-blue-500 underline">
            + 新しい犬を登録
        </a>

        <ul class="mt-4">
            @forelse ($dogs as $dog)
                <li class="border-b py-2">
                    {{ $dog->name }}（{{ $dog->size }}）
                    @can('update', $dog)
                        <a href="{{ route('dogs.edit', $dog) }}" class="text-blue-600 underline mr-2">編集</a>
                    @endcan
                    @can('delete', $dog)
                        <form action="{{ route('dogs.destroy', $dog) }}" method="post" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 underline">削除</button>
                        </form>
                    @endcan
                </li>
            @empty
                <li>まだ犬がいません🐕</li>
            @endforelse
        </ul>
    </div>
</x-app-layout>
