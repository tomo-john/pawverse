<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 flex flex-col">

    <div class="min-h-screen flex flex-col justify-center items-center px-4 my-4">

        <a href="{{ route('home') }}"
           x-data="welcomeDog()"
           @mouseenter="hover = true"
           @mouseleave="hover = false"
        >
            <div x-show="show"
                 x-transition:enter="translate-y-4 opacity-0"
                 x-transition:enter-end="translate-y-0 opacity-100"
                 :class="show ? '' : 'translate-y-4 opacity-0'"
                 class="transition-all duration-700 ease-out transform"
            >
                <i class="fa-solid fa-dog text-6xl text-pink-500 mb-8 drop-shadow-lg transition-all duration-200 active:scale-90"
                   :class="hover ? 'scale-125 rotate-6' : ''"
                ></i>
            </div>
        </a>

        <div class="w-full max-w-sm">
            {{ $slot }}
        </div>

        <p class="mt-8 text-gray-400 text-xs">© 2026 pawverse</p>
    </div>

    <script>
        function welcomeDog() {
            return {
                show: false,
                hover: false,

                init() {
                    setTimeout(() => {
                        this.show = true;
                    }, 100);
                },

            }
        }
    </script>

    @fluxScripts
</body>
</html>
