<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body class="antialiased font-sans">

    <div class="min-h-screen flex flex-col justify-center items-center px-4 my-4">

        <a href="{{ route('home') }}">
            <i class="fa-solid fa-dog text-9xl text-pink-500 mb-8 drop-shadow-lg"></i>
        </a>

        <div class="w-full max-w-sm">
            {{ $slot }}
        </div>

        <p class="mt-8 text-gray-400 text-xs">© 2026 pawverse</p>
    </div>

    @fluxScripts
</body>
</html>
