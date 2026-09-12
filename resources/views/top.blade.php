<x-layouts.guest>
    <div class="max-w-5xl mx-auto space-y-8 py-16 px-6">

        <flux:main container>

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

        </flux:main>
    </div>
</x-layouts.guest>
