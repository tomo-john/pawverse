<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fa-solid fa-paw"></i>
            Pawverse Dashbord
        </h2>
    </x-slot>

    <div class="p-6 mx-w-5xl mx-auto">

        <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Home -->
            <li>
                <a href="/" class="block bg-white rounded-2xl shadow p-6 hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="text-4xl text-pink-400 mb-3">
                        <i class="fa-solid fa-house"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-1">Home</h3>
                    <p class="text-sm text-gray-500">Pawverseの入り口</p>
                </a>
            </li>

            <!-- Dogs -->
            <li>
                <a href="{{ route('dogs.index') }}" class="block bg-white rounded-2xl shadow p-6 hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="text-4xl text-amber-500 mb-3">
                        <i class="fa-solid fa-dog"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-1">Dogs</h3>
                    <p class="text-sm text-gray-500">犬たちを管理する</p>
                </a>
            </li>

            <!-- Sandbox -->
            <li>
                <a href="{{ route('sandbox') }}" class="block bg-white rounded-2xl shadow p-6 hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="text-4xl text-blue-400 mb-3">
                        <i class="fa-solid fa-flask"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-1">Sandbox</h3>
                    <p class="text-sm text-gray-500">実験場</p>
                </a>
            </li>

            <!-- Admin Dashboard -->
            <li>
                <a href="{{ route('admin.dashboard') }}" class="block bg-white rounded-2xl shadow p-6 hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="text-4xl text-red-400 mb-3">
                        <i class="fa-solid fa-crown"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-1">Admin Dashboard</h3>
                    <p class="text-sm text-gray-500">管理者画面</p>
                </a>
            </li>

        </ul>
    </div>
</x-app-layout>
