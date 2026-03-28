@component('layouts.guest')
    <div class="max-w-5xl mx-auto space-y-4 py-16">

        <flux:main container>
            <!-- Hero -->
            <flux:heading size="xl" level="1" class="bg-gradient-to-r from-pink-500 via-rose-500 to-fuchsia-500 bg-clip-text text-transparent">
                Pawverse
            </flux:heading>
            <flux:text class="mt-2 mb-6 text-base">
                あたなだけのわんこを育てて記録するアプリ🐶
            </flux:text>
            <flux:separator variant="subtle" class="mb-4" />

            <!-- 説明 -->
            <flux:heading size="md" level="2">🐾こんなアプリ🐾</flux:heading>
            <flux:text class="mt-2 mb-6 text-sm text-base">
                Laravel 12 個人開発・学習用兼ポートフォリオです(作成途中)<br>
                犬をテーマにしたアプリにしたい。
            </flux:text>
            <flux:separator variant="subtle" class="mb-4" />

            <!-- 機能紹介 -->
            <flux:heading size="md" level="2">🦮機能紹介🦮</flux:heading>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
                <div class="bg-pink-50 p-10 rounded-2xl border-2 border-pink-200 flex flex-col gap-2 items-center hover:-translate-y-1 transition duration-300 hover:scale-105">
                    <i class="fa-solid fa-dog text-pink-500 text-4xl mb-2"></i>
                    <span class="text-sm font-bold text-pink-700">あたなだけのわんこを迎える</span>
                </div>
                <div class="bg-rose-50 p-10 rounded-2xl border-2 border-rose-200 flex flex-col gap-2 items-center hover:-translate-y-1 transition duration-300 hover:scale-105">
                    <i class="fa-solid fa-dog text-rose-500 text-4xl mb-2"></i>
                    <span class="text-sm font-bold text-rose-700">わんこのお世話</span>
                </div>
                <div class="bg-fuchsia-50 p-10 rounded-2xl border-2 border-fuchsia-200 flex flex-col gap-2 items-center hover:-translate-y-1 transition duration-300 hover:scale-105">
                    <i class="fa-solid fa-dog text-fuchsia-500 text-4xl mb-2"></i>
                    <span class="text-sm font-bold text-fuchsia-700">そしてわんこは...</span>
                </div>
            </div>

            <div class="flex items-center gap-4 mb-6">
                <flux:button href="{{ route('public.dog.index') }}" variant="subtle" icon="sparkles" wire:navigate>
                    Public Dogs
                </flux:button>
                <span class="text-sm text-gray-500 font-medium">
                    <i class="fa-solid fa-circle-left"></i>
                    よかったらのぞいてみてね🐶
                </span>
            </div>

            <flux:separator variant="subtle" class="mb-4" />

            <!-- CTA的な -->
            <flux:heading size="md" level="2">🐶気になったら🐶</flux:heading>
            <div class="flex gap-4 mt-2 mb-6 bg-zinc-100 dark:bg-zinc-900 rounded-2xl p-8">
                <flux:button variant="primary" color="pink" class="px-8 shadow-lg" as="a" href="{{ route('register') }}">
                    わんこを迎えてみる(新規登録)
                    <i class="fa-solid fa-dog mx-1"></i>
                </flux:button>
                <flux:button variant="ghost" class="px-8 shadow-lg" as="a" href="{{ route('login') }}">
                    ログイン
                    <i class="fa-solid fa-dog mx-1"></i>
                </flux:button>
            </div>
            <flux:separator variant="subtle" class="mb-4" />

            <!-- Sandboxリンク -->
            <flux:heading size="sm" level="3">検証用ページ</flux:heading>
            <div class="flex justify-center items-center mt-2 gap-4">
                <a href="{{ route('sandbox.index') }}">
                    <flux:button variant="primary" color="pink">
                        <i class="fa-solid fa-dog"></i>
                    </flux:button>
                </a>
            </div>

        </flux:main>
    </div>
@endcomponent
