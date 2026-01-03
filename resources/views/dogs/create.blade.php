<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            犬を登録する 🐶
        </h2>
    </x-slot>

    <div x-data="{
            name: '{{ old('name', $dog->name ?? '') }}',
            color: '{{ old('color', $dog->color ?? 'gray') }}',
            size: '{{ old('size', $dog->size ?? 'medium') }}',
            sizeClass() {
                return {
                    small: 'text-4xl',
                    medium: 'text-6xl',
                    large: 'text-8xl'
                }[this.size]
            },
            colorClass() {
                return {
                    white: 'text-white drop-shadow',
                    black: 'text-black',
                    gray: 'text-gray-500',
                    brown: 'text-amber-800',
                    gold: 'text-yellow-500'
                }[this.color]
            }
    }">
        <!-- プレビューエリア -->
        @include('dogs._preview')

        <!-- 登録フォーム -->
        @include('dogs._form', [
            'action' => route('dogs.store'),
            'method' => 'POST',
            'dog' => $dog,
            'submitText' => '登録'
        ])

        <!-- 戻るリンク -->
        <div class="max-w-2xl mx-auto text-center text-gray-500">
            <a href="{{ route('dogs.index') }}">
                <i class="fa-solid fa-backward"></i>
                一覧へ戻る
                <i class="fa-solid fa-dog ml-1 -scale-x-100"></i>
            </a>
        </div>
    </div>
</x-app-layout>
