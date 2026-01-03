<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            犬を登録する 🐶
        </h2>
    </x-slot>

    <div x-data="{
        name: '{{ old('name') }}',
        color: '{{ old('color', 'gray') }}',
        size: '{{ old('size', 'medium') }}',
        sizeClass() {
            return {
                small: 'text-4xl',
                medium: 'text-6xl',
                large: 'text-8xl'
            }[this.size]
        },
        colorClass() {
            return {
                white: 'text-white drop-shadow',
                black: 'text-black',
                gray: 'text-gray-500',
                brown: 'text-amber-800',
                gold: 'text-yellow-500'
            }[this.color]
        }
    }">

        <!-- プレビューエリア -->
        <div class="w-[256px] h-[256px] border bg-gray-200 mx-auto m-8 shadow-inner rounded-lg overflow-hidden">
            <div class="h-full flex flex-col p-4">
                <p class="text-xs text-gray-400 font-mono font-bold text-center italic">preview_dog</p>
                <div class="flex-grow flex items-center justify-center transition">
                    <i class="fa-solid fa-dog transition-all  duration-1000"
                       :class="[ sizeClass(), colorClass() ]">
                    </i>
                </div>
                <p class="text-md font-mono font-semibold text-center border-t border-dashed pt-2"
                    x-text="name || 'no name'">
                </p>
            </div>
        </div>

        <!-- 登録フォーム -->
        <div class="max-w-2xl mx-auto px-6 py-4">
            <div class="bg-white rounded-2xl shadow-md p-6">
                <form method="POST" action="{{ route('dogs.store') }}" class="space-y-5">
                    @csrf

                    <!-- 名前 -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fa-solid fa-dog text-rose-500 mr-1"></i>名前
                        </label>
                        <input name="name"
                               x-model="name"
                               class="w-full rounded-lg border-gray-300 focus:border-pink-400 focus:ring-pink-300"
                               value="{{ old('name', $dog->name ) }}">
                        @error('name')
                          <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- 毛色 -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fa-solid fa-palette text-yellow-500 mr-1"></i>毛色
                        </label>
                        <select name="color"
                                x-model="color"
                                class="w-full rounded-lg border-gray-300 focus:border-pink-400 focus:ring-pink-300">
                            @foreach ($colors as $value => $label)
                                <option value="{{ $value }}"
                                        @selected(old('color', $dog->color) === $value)>
                                        {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('color')
                          <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- サイズ -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fa-solid fa-weight-scale text-blue-500 mr-1"></i>サイズ
                        </label>
                        <select name="size"
                                x-model="size"
                                class="w-full rounded-lg border-gray-300 focus:border-pink-400 focus:ring-pink-300">
                            @foreach ($sizes as $value => $label)
                                <option value="{{ $value }}"
                                        @selected(old('size', $dog->size) === $value)>
                                        {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('size')
                          <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- 公開flg -->
                    <div class="flex items-center gap-2">
                        <input type="checkbox"
                               name="is_public"
                               value="1"
                               class="rounded border-gray-300 text-pink-500 focus:ring-pink-400"
                               @checked(old('is_public', $dog->is_public))>
                        <span class="text-sm text-gray-700">
                            公開する
                        </span>
                    </div>

                    <button class="w-full rounded-xl transition bg-pink-500 hover:bg-pink-600 text-white font-semibold mt-4 py-2">
                        登録
                    </button>
                </form>
            </div>
        </div>

        <!-- 戻るリンク -->
        <div class="max-w-2xl mx-auto text-center text-gray-500">
            <a href="{{ route('dogs.index') }}">
                <i class="fa-solid fa-backward"></i>
                一覧へ戻る
                <i class="fa-solid fa-dog ml-1 -scale-x-100"></i>
            </a>
        </div>
    </div>
</x-app-layout>
