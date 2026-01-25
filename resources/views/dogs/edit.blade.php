<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            犬を編集する 🐶
        </h2>
    </x-slot>

    <!-- componment呼び出し -->
    <x-dog.form
        :dog="$dog"
        :colors="$colors"
        :sizes="$sizes"
        action="{{ route('dogs.update', $dog) }}"
        method="PUT"
        submit-text="更新"
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
