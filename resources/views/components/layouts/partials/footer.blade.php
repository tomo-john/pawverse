{{-- 共通フッター🐶 --}}
<footer class="mt-20 border-t border-pink-200 dark:border-pink-900 pt-8 pb-6 text-center">

    <div class="text-lg font-semibold text-pink-600">
        <img src="{{ asset('favicon.svg')}}" alt="Pawverse logo" class="w-8 h-8 inline align-middle">
        Pawverse
        <i class="fa-solid fa-dog"></i>
    </div>

    <p class="text-sm text-zinc-500 mt-2">
        あなただけのわんこを育てる場所
    </p>

    <div class="flex justify-center gap-6 mt-4 text-sm">
        <a href="#" class="text-pink-500 hover:text-pink-600">About</a>
        <a href="#" class="text-pink-500 hover:text-pink-600">Privacy</a>
        <a href="#" class="text-pink-500 hover:text-pink-600">Contact</a>
    </div>

    <div class="text-xs text-zinc-400 mt-6">
        © {{ date('Y') }} Pawverse
    </div>

</footer>
