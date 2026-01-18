<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-600">
            👑 Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            <div class="bg-white shadow rounded-lg p-6">
                <p class="text-lg font-semibold">
                    管理者専用ページ 🐶
                </p>
                <p class="text-sm text-gray-500">
                    ここから管理者機能を追加していきます
                </p>
            </div>

            <div class="bg-gray-50 border rounded-lg p-4">
                <p class="text-sm text-gray-600">
                    logged in as:
                    <span class="font-mono text-red-600">
                        {{ auth()->user()->email }}
                    </span>
                </p>
            </div>

        </div>
    </div>
</x-app-layout>
