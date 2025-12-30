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
                </li>
            @empty
                <li>まだ犬がいません🐕</li>
            @endforelse
        </ul>
    </div>
</x-app-layout>
