<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            犬を登録する 🐶
        </h2>
    </x-slot>

    <x-dog.form
        :dog="$dog"
        :colors="$colors"
        :sizes="$sizes"
        action="{{ route('dogs.store') }}"
        submit-text="登録"
    />

    <!-- 戻るリンク -->
    <div class="max-w-2xl mx-auto text-center text-gray-500">
        <a href="{{ route('dogs.index') }}">
            <i class="fa-solid fa-backward"></i>
            一覧へ戻る
            <i class="fa-solid fa-dog ml-1 -scale-x-100"></i>
        </a>
    </div>
</x-app-layout>
