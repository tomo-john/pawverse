<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Public Dogs 🐶
        </h2>
    </x-slot>

    <div class="p-6">
        <ul>
            @forelse ($dogs as $dog)
                <li class="flex justify-between border rounded-xl p-4 mb-4 bg-white shadow-sm">
                    <div>
                        <a href="{{ route('dogs.show', $dog) }}"
                           class="font-semibold text-lg hover:text-pink-500">
                            {{ $dog->name }}
                        </a>

                        <div class="text-sm text-gray-500">
                            {{ $dog->size }}
                            <span class="ml-2 text-green-600"><i class="fa-solid fa-palette text-yellow-500 mr-1"></i>公開中</span>
                        </div>
                    </div>

                    <div class="self-center">
                        <span class="text-sm text-gray-500 mr-2">飼い主: </span>
                        <button class="font-semibold text-md bg-yellow-500 hover:bg-yellow-600 rounded-full px-4 py-2">
                            {{ $dog->user['name'] }}
                        </button>
                    </div>
                </li>
            @empty
                <li>まだ公開されている犬はいません🐶</li>
            @endforelse
        </ul>
    </div>
</x-app-layout>

