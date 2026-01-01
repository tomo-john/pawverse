<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Public Dogs 🐶
        </h2>
    </x-slot>

    <div class="p-6">
        <ul>
            @forelse ($dogs as $dog)
                <li class="border rounded-xl p-4 mb-4 bg-white shadow-sm">
                    <a href="{{ route('dogs.show', $dog) }}"
                       class="font-semibold text-lg hover:text-pink-500">
                        {{ $dog->name }}
                    </a>

                    <div class="text-sm text-gray-500">
                        {{ $dog->size }}
                        <span class="ml-2 text-green-600">🌍 公開中</span>
                    </div>
                </li>
            @empty
                <li>まだ公開されている犬はいません🐶</li>
            @endforelse
        </ul>
    </div>
</x-app-layout>

