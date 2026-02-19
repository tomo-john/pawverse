{{-- 共通ヘッダー🐶 --}}
<header class="bg-white dark:bg-zinc-800 shadow p-4 flex justify-between">
    <h1 class="font-bold text-lg">
        Pawverse 🐶
    </h1>

    <nav class="space-x-4">
        <a href="{{ route('home') }}" class="hover:underline">Home</a>
        <a href="{{ route('public.dog.index')}}" class="hover:underline">Dogs</a>

        @auth
            <a href="{{ route('dashboard')}}" class="text-blue-500">Dashboard</a>
        @endauth

        @guest
            <a href="{{ route('login') }}" class="text-blue-500">Login</a>
        @endguest
    </nav>
</header>
