<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            {{ $dog->name }} 🐶
        </h2>
    </x-slot>

    <div class="p-6 space-y-4">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow p-6">
            <p><i class="fa-solid fa-palette text-yellow-500 mr-1"></i> 毛色: {{ $dog->color }}</p>
            <p><i class="fa-solid fa-weight-scale text-blue-500 mr-1"></i> サイズ: {{ $dog->size }}</p>

            @if ($dog->is_public)
                <p class="text-green-600 mt-2"><i class="fa-solid fa-earth-americas mr-1"></i>公開中</p>
            @else
                <p class="text-gray-500 mt-2"><i class="fa-solid fa-lock mr-1"></i>非公開</p>
            @endif
        </div>

        <div class="max-w-2xl mx-auto text-center text-gray-500">
            <a href="{{ route('dogs.index') }}">
                <i class="fa-solid fa-backward"></i>
                一覧へ戻る
                <i class="fa-solid fa-dog ml-1 -scale-x-100"></i>
            </a>
        </div>
    </div>
</x-app-layout>
