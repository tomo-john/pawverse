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
</x-app-layout>
