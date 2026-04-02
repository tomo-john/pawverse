{{-- 共通ヘッダー🐶 --}}
<header class="sticky top-0 z-50 backdrop-blur bg-white/70 dark:bg-zinc-900/70 border-b border-zinc-200 dark:border-zinc-800">
    <div class="max-w-6xl mx-auto flex items-center justify-between px-6 py-3">

        {{-- ロゴ --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2 text-pink-600 font-semibold">
            <img src="{{ asset('favicon.svg')}}" class="w-7 h-7">
            <span class="tracking-tight">Pawverse</span>
        </a>

        {{-- ナビ --}}
        <nav class="flex items-center gap-6 text-sm font-medium">

            <a href="{{ route('home') }}" class="hover:text-pink-500 transition">
                Home
            </a>

            <a href="{{ route('public.dog.index')}}" class="hover:text-pink-500 transition">
                Public Dogs
            </a>

            @auth
                <flux:dropdown>
                    <flux:button variant="ghost" icon-trailing="chevron-down" class="text-pink-600 font-bold">
                        My Dog
                    </flux:button>

                    <flux:menu>
                        <flux:menu.item href="{{ route('dog.index') }}" icon="star">My Dog</flux:menu.item>
                        <flux:menu.item href="{{ route('dashboard') }}" icon="layout-grid">Dashboard</flux:menu.item>
                        <flux:menu.item href="{{ route('profile.edit') }}" icon="cog">Profile</flux:menu.item>
                        <flux:menu.separator />
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <flux:menu.item
                                as="button"
                                type="submit"
                                icon="arrow-right-start-on-rectangle"
                                class="w-full cursor-pointer"
                                variant="danger"
                            >
                                Logout
                            </flux:menu.item>
                        </form>
                    </flux:menu>
                </flux:dropdown>
            @endauth

            @guest
                <a href="{{ route('login') }}"
                   class="px-4 py-1.5 rounded-full bg-pink-500 text-white hover:bg-pink-600 transition shadow-sm">
                    Login
                </a>
            @endguest

        </nav>
    </div>
</header>
