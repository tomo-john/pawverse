<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-pink-50 text-slate-900 flex flex-col">

    <div class="min-h-screen flex flex-col justify-center items-center px-4 my-4">

        <div class="fixed inset-0 pointer-events-none opacity-[0.03]">
            <div class="absolute top-10 left-10 rotate-12">
                <i class="fa-solid fa-paw text-[120px]"></i>
            </div>
            <div class="absolute bottom-20 right-10 -rotate-12">
                <i class="fa-solid fa-paw text-[160px]"></i>
            </div>
            <div class="absolute top-1/2 left-1/3 rotate-6">
                <i class="fa-solid fa-paw text-[100px]"></i>
            </div>
        </div>

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

        <div class="w-full max-w-sm" x-data="followDog()">
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

        function followDog() {
            return {
                topPos: 0,
                visible: false,

                updatePos(event) {
                    const inputRect = event.target.getBoundingClientRect();
                    const formRect = this.$refs.form.getBoundingClientRect();

                    this.topPos = inputRect.top - formRect.top + inputRect.height / 2 -10;
                    this.visible = true;
                },

                resetPos() {
                    this.visible = false;
                },
            }
        }

    </script>

    @fluxScripts
</body>
</html>
