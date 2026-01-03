<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            犬を登録する 🐶
        </h2>
    </x-slot>

    <!-- プレビューエリア -->
    <div class="w-[256px] h-[256px] border bg-gray-200 mx-auto m-8 shadow-inner rounded-lg overflow-hiddne">
        <div class="h-full flex flex-col p-4">
            <p class="text-xs text-gray-400 font-mono font-bold text-center italic">preview_dog</p>
            <div class="flex-grow flex items-center justify-center text-6xl">
                <i class="fa-solid fa-dog"></i>
            </div>
            <p class="text-md text-pink-600 font-mono font-semibold text-center border-t border-dashed border-pink-200 pt-2">name</p>
        </div>
    </div>

    <!-- 登録フォーム -->
    <div class="max-w-2xl mx-auto px-6 py-4">
        <div class="bg-white rounded-2xl shadow-md p-6">
            <form method="POST" action="{{ route('dogs.store') }}" class="space-y-5">
                @csrf
                @include('dogs._form', ['submitText' => '登録'])
            </form>
        </div>
    </div>

    <!-- 戻るリンク -->
    <div class="max-w-2xl mx-auto text-center text-gray-500">
        <a href="{{ route('dogs.index') }}">
            <i class="fa-solid fa-backward"></i>
            一覧へ戻る
            <i class="fa-solid fa-dog ml-1 -scale-x-100"></i>
        </a>
    </div>
</x-app-layout>
