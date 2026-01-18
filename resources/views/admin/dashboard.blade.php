<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-600">
            <i class="fa-solid fa-crown"></i>
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-6">

        <!-- users -->
        <div class="bg-white rounded-2xl shadow p-6 text-center">
            <div class="text-4xl mb-2"><i class="fa-solid fa-user"></i></div>
            <div class="text-sm text-gray-500">ユーザー数</div>
            <div class="text-3xl font-bold">{{ $userCount }}</div>
        </div>

        <!-- dogs -->
        <div class="bg-white rounded-2xl shadow p-6 text-center">
            <div class="text-4xl mb-2"><i class="fa-solid fa-dog"></i></div>
            <div class="text-sm text-gray-500">犬の数</div>
            <div class="text-3xl font-bold">{{ $dogCount }}</div>
        </div>

    </div>

</x-app-layout>
