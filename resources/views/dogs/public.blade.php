<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Public Dogs 🐶
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="p-6">
        <ul>
            @forelse ($dogs as $dog)
                <li class="flex gap-4 border rounded-xl p-4 mb-4 bg-white shadow-sm">
                    <div>
                        <a href="{{ route('dogs.show', $dog) }}"
                           class="font-semibold text-lg text-gray-800 hover:text-pink-500">
                            {{ $dog->name }}
                        </a>

                        <div class="text-sm text-gray-500">
                            {{ $sizes[$dog->size] }}
                            <span class="ml-2 text-green-600"><i class="fa-solid fa-palette text-yellow-500 mr-1"></i>公開中</span>
                        </div>
                    </div>

                    @can('togglePublic', $dog)
                        <form action="{{ route('dogs.toggle-public', $dog) }}"
                              method="post"
                              class="mt-2">
                            @csrf
                            @method('PATCH')

                            <button
                                class="text-sm px-3 py-1 rounded-full
                                       {{ $dog->is_public
                                            ? 'bg-gray-200 hover:bg-gray-300 text-gray-700'
                                            : 'bg-pink-500 hover:bg-pink-600 text-white' }}">
                                {{ $dog->is_public ? '非公開にする' : '公開する'}}
                            </button>
                        </form>
                    @endcan

                    <div class="ml-auto self-center">
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

