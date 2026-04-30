<x-layouts.auth>
    <div class="flex flex-col gap-8 bg-white p-10 rounded-2xl shadow-xl shadow-pink-100/50 border-4 border-white relative overflow-hidden">

        <i class="fa-solid fa-paw absolute -top-4 -right-4 text-pink-50 text-8xl rotate-12 -z-0"></i>

        <div class="relative z-10 space-y-2 text-center">
            <h2 class="text-2xl font-black text-pink-600 tracking-tighter">{{ __('Log in to your account') }}</h2>
            <p class="text-slate-500 text-sm">おかえりなさい🐶</p>
        </div>

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-5 relative z-10">
            @csrf

            <div class="space-y-1">
                <label class="block text-sm font-bold text-slate-700 ml-1" for="email">{{ __('Email address') }}</label>
                <input id="email"
                       name="email"
                       type="email"
                       value="{{ old('email') }}"
                       placeholder="email@example.com"
                       required
                       autofocus
                       autocomplete="email"
                       class="w-full bg-pink-50/30 px-4 py-3 rounded-2xl border-2 border-pink-100 focus:border-pink-400 focus:ring-2 focus:ring-pink-200 transition-all outline-none"
                >
                @error('email')
                    <p class="text-xs text-rose-500 mt-1 ml-2 font-bold">{{ $message }}</p>
                @enderror
            </div>

            <div x-data="{ show: false }" class="space-y-1 relative">
                <label class="block text-sm font-bold text-slate-700 ml-1" for="password">
                    {{ __('Password') }}
                </label>

                <div class="relative">
                    <input id="password"
                           name="password"
                           :type="show ? 'text' : 'password'"
                           required
                           autocomplete="current-password"
                           class="w-full bg-pink-50/30 px-4 py-3 rounded-2xl border-2 border-pink-100 focus:border-pink-400 focus:ring-2 focus:ring-pink-200 transition-colors outline-none"
                    >

                    <button type="button"
                            @click="show = !show"
                            class="absolute inset-y-0 right-3 flex items-center text-slate-400 hover:text-pink-500"
                    >
                        <i x-show="!show" class="fa-solid fa-eye"></i>
                        <i x-show="show" class="fa-solid fa-eye-slash"></i>
                    </button>
                </div>

                @error('password')
                    <p class="text-xs text-rose-500 mt-1 ml-2 font-bold">{{ $message }}</p>
                @enderror

                <a href="{{ route('password.request') }}"
                   class="absolute top-0 right-0 text-xs font-bold text-pink-400 hover:text-pink-600 transition-colors"
                   wire:navigate
                >
                    {{ __('Forgot your password?') }}
                </a>
            </div>

            <div class="flex items-center gap-2 ml-1">
                <label for="remember" class="flex items-center gap-2 cursor-pointer group">
                    <input id="remember"
                           name="remember"
                           type="checkbox"
                           {{ old('remember') ? 'checked' : '' }}
                           class="w-4 h-4 rounded-2xl border-2 border-pink-100 accent-pink-500"
                    >
                    <span class="text-sm font-bold text-slate-500">{{ __('Remember me') }}</span>
                </label>
            </div>


            <div class="pt-4">
                <flux:button type="submit" variant="primary" color="pink"
                             class="w-full py-6 rounded-2xl shadow-lg shadow-pink-200 text-lg font-bold transition-all active:scale-95"
                             data-test="login-button"
                >
                    {{ __('Log in') }}
                    <i class="fa-solid fa-dog ml-2"></i>
                </flux:button>
            </div>

        </form>

        <div class="relative z-10 space-x-1 text-center text-sm text-slate-500 font-medium border-t border-slate-100 pt-6">
            <span>{{ __('Don\'t have an account?') }}</span>
            <flux:link :href="route('register')" wire:navigate class="text-pink-600 font-bold hover:text-pink-700">{{ __('Sign up') }}</flux:link>
        </div>
    </div>
</x-layouts.auth>
