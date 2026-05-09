<x-layouts.guest>
    <div class="max-w-5xl mx-auto space-y-8 py-16 px-6">

        <flux:main container>
            <div class="text-center mb-12">
                <flux:heading size="xl" level="1" class="bg-gradient-to-r from-pink-500 via-rose-500 to-fuchsia-500 bg-clip-text text-transparent font-black tracking-tighter">
                    Pawverse
                </flux:heading>
                <flux:text class="mt-4 text-lg text-slate-600 font-medium">
                    あたなだけのわんこを育てて記録するアプリ
                    <i class="fa-solid fa-dog"></i>
                </flux:text>
            </div>

            <flux:separator class="!bg-pink-200 mb-10" />

            <section>
                <flux:heading size="md" level="2" class="flex items-center gap-2 text-slate-700">
                    <span class="text-xl"><i class="fa-solid fa-paw"></i></span>Pawverseへようこそ
                </flux:heading>
                <div class="mt-4 mb-10 p-6 bg-white border border-pink-100 rounded-3xl shadow-sm">
                    <flux:text class="text-slate-500 leading-relaxed">
                        Laravel 12 個人開発・学習用兼ポートフォリオです(作成途中)<br>
                        犬をテーマにしたアプリにしたい。
                    </flux:text>
                </div>
            </section>

            <section>
                <flux:heading size="md" level="2" class="flex items-center gap-2 text-slate-700">
                    <span class="text-xl"><i class="fa-solid fa-bone"></i></span>機能紹介
                </flux:heading>
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
            </section>

            <section>
                <flux:heading size="md" level="2" class="flex items-center gap-2 text-slate-700">
                    <span class="text-xl"><i class="fa-solid fa-shield-dog"></i></span>Test Section
                </flux:heading>

                <div class="flex items-center gap-4 mt-4 mb-10">
                    <flux:button href="{{ route('public.dog.index') }}" icon="sparkles" wire:navigate class="!bg-pink-200 !text-pink-900 rounded-full px-6 hover:!bg-pink-300">
                        みんなのわんこをのぞく
                    </flux:button>
                </div>
            </section>

            <flux:separator class="!bg-pink-200 mb-10" />

            <section class="bg-gradient-to-br from-pink-50 to-orange-50 rounded-2xl p-10 text-center border-2 border-white shadow-liner">
                <flux:heading size="md" level="2" class="text-pink-600 mb-6">
                    待ってるわん
                    <i class="fa-solid fa-dog"></i>
                </flux:heading>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <flux:button variant="primary" color="pink" class="px-10 py-6 rounded-full shadow-lg shadow-pink-200/50 text-lg" as="a" href="{{ route('register') }}">
                        わんこを迎えてみる(新規登録)
                        <i class="fa-solid fa-dog mx-1"></i>
                    </flux:button>
                    <flux:button variant="ghost" class="px-10 py-6 rounded-full shadow-lg !text-slate-500 hover:!text-pink-600" as="a" href="{{ route('login') }}">
                        ログイン
                        <i class="fa-solid fa-dog mx-1"></i>
                    </flux:button>
                </div>
            </section>

            <!-- Sandbox -->
            <div class="mt-20 pt-10 border-t border-slate-100 flex flex-col items-center gap-4">
                <flux:text class="text-xs text-slate-400">Sandbox</flux:text>
                <a href="{{ route('sandbox.page', 'index') }}" class="opacity-50 hover:opacity-100 transition">
                    <flux:button variant="primary" color="pink" size="sm">
                        <i class="fa-solid fa-dog"></i>
                    </flux:button>
                </a>
            </div>

        </flux:main>
    </div>
</x-layouts.guest>
