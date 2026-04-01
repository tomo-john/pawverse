<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800 flex flex-col">

    {{-- ヘッダー🐶 --}}
    <x-layouts.partials.header />

    {{-- メインコンテンツ🐶 --}}
    <main class="flex-1">
        {{ $slot }}
    </main>

    {{-- フッター🐶 --}}
    <x-layouts.partials.footer />

    @fluxScripts
</body>
</html>
