<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <div class="max-w-5xl mx-auto space-y-4 p-4 m-4">

            <div>
                sandbox.index本体
                <i class="fa-solid fa-dog text-yellow-500"></i>
            </div>

            <!-- Component呼び出し -->
            <x-sandbox.dog />
        </div>


        @fluxScripts
    </body>
</html>
