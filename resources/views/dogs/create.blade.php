<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            犬を登録する 🐶
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto px-6 py-8">
        <div class="bg-white rounded-2xl shadow-md p-6">
            <form method="POST" action="{{ route('dogs.store') }}" class="space-y-5">
                @csrf
                @include('dogs._form', ['submitText' => '登録'])
            </form>
        </div>
    </div>

    <div class="max-w-2xl mx-auto text-center text-gray-500">
        <a href="{{ route('dogs.index') }}">
            <i class="fa-solid fa-backward"></i>
            一覧へ戻る
            <i class="fa-solid fa-dog ml-1 -scale-x-100"></i>
        </a>
    </div>
</x-app-layout>
