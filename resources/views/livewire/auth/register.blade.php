<x-layouts.auth>
    <div class="flex flex-col gap-8 bg-white p-10 rounded-2xl shadow-xl shadow-pink-100/50 border-4 border-white relative overflow-hidden" x-ref="form">

        <i class="fa-solid fa-paw absolute -top-4 -right-4 text-pink-50 text-8xl rotate-12 -z-0"></i>

        <i class="fa-solid fa-dog text-pink-400 absolute transition-all duration-200 ease-in-out z-20"
           :style="`
                top: ${topPos}px;
                transform: translateX(${visible ? '-30px' : '-60px'});
           `"
        ></i>

        <div class="relative z-10 space-y-2 text-center">
            <h2 class="text-2xl font-black text-pink-600 tracking-tighter">{{ __('Create an account') }}</h2>
            <p class="text-slate-500 text-sm">新しいわんこライフを始めよう🐶</p>
        </div>

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-5 relative z-10">
            @csrf

            <div class="space-y-1 flex-1">
                <label class="block text-sm font-bold text-slate-700 ml-1" for="name">{{ __('Name') }}</label>
                <input id="name"
                       name="name"
                       type="text"
                       value="{{ old('name') }}"
                       placeholder="{{ __('Full name') }}"
                       required
                       autofocus
                       autocomplete="name"
                       class="w-full bg-pink-50/30 px-4 py-3 rounded-2xl border-2 border-pink-100 focus:border-pink-400 focus:ring-2 focus:ring-pink-200 transition-all outline-none"
                       @focus="updatePos($event)"
                       @blur="resetPos()"
                >
                @error('name')
                    <p class="text-xs text-rose-500 mt-1 ml-2 font-bold">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-1">
                <label class="block text-sm font-bold text-slate-700 ml-1" for="email">{{ __('Email address') }}</label>
                <input id="email"
                       name="email"
                       type="email"
                       value="{{ old('email') }}"
                       placeholder="email@example.com"
                       required
                       autocomplete="email"
                       class="w-full bg-pink-50/30 px-4 py-3 rounded-2xl border-2 border-pink-100 focus:border-pink-400 focus:ring-2 focus:ring-pink-200 transition-colors outline-none"
                       @focus="updatePos($event)"
                       @blur="resetPos()"
                >
                @error('email')
                    <p class="text-xs text-rose-500 mt-1 ml-2 font-bold">{{ $message }}</p>
                @enderror
            </div>

            <div x-data="{ show: false }" class="space-y-1">
                <label class="block text-sm font-bold text-slate-700 ml-1" for="password">
                    {{ __('Password') }}
                </label>

                <div class="relative">
                    <input id="password"
                           name="password"
                           :type="show ? 'text' : 'password'"
                           required
                           autocomplete="new-password"
                           class="w-full bg-pink-50/30 px-4 py-3 rounded-2xl border-2 border-pink-100 focus:border-pink-400 focus:ring-2 focus:ring-pink-200 transition-colors outline-none"
                           @focus="updatePos($event)"
                           @blur="resetPos()"
                    >
                    <button type="button"
                            @click="show = !show"
                            @focus="updatePos($event)"
                            @blur="resetPos()"
                            class="absolute inset-y-0 right-3 flex items-center text-slate-400 hover:text-pink-500"
                    >
                        <i x-show="!show" class="fa-solid fa-eye"></i>
                        <i x-show="show" class="fa-solid fa-eye-slash"></i>
                    </button>
                </div>

                @error('password')
                    <p class="text-xs text-rose-500 mt-1 ml-2 font-bold">{{ $message }}</p>
                @enderror
            </div>

            <div x-data="{ show: false }" class="space-y-1">
                <label class="block text-sm font-bold text-slate-700 ml-1" for="password_confirmation">
                    {{ __('Confirm password') }}
                </label>

                <div class="relative">
                    <input id="password_confirmation"
                           name="password_confirmation"
                           :type="show ? 'text' : 'password'"
                           required
                           autocomplete="new-password"
                           class="w-full bg-pink-50/30 px-4 py-3 rounded-2xl border-2 border-pink-100 focus:border-pink-400 focus:ring-2 focus:ring-pink-200 transition-colors outline-none"
                           @focus="updatePos($event)"
                           @blur="resetPos()"
                    >
                    <button type="button"
                            @click="show = !show"
                            @focus="updatePos($event)"
                            @blur="resetPos()"
                            class="absolute inset-y-0 right-3 flex items-center text-slate-400 hover:text-pink-500"
                    >
                        <i x-show="!show" class="fa-solid fa-eye"></i>
                        <i x-show="show" class="fa-solid fa-eye-slash"></i>
                    </button>
                </div>
            </div>

            <div class="pt-4">
                <flux:button type="submit" variant="primary" color="pink"
                             class="w-full py-6 rounded-2xl shadow-lg shadow-pink-200 text-lg font-bold transition-all active:scale-95"
                             data-test="register-user-button"
                >
                    {{ __('Create account') }}
                    <i class="fa-solid fa-dog ml-2"></i>
                </flux:button>
            </div>
        </form>

        <div class="relative z-10 space-x-1 text-center text-sm text-slate-500 font-medium border-t border-slate-100 pt-6">
            <span>{{ __('Already have an account?') }}</span>
            <flux:link :href="route('login')" wire:navigate class="text-pink-600 font-bold hover:text-pink-700">{{ __('Log in') }}</flux:link>
        </div>
    </div>
</x-layouts.auth>
