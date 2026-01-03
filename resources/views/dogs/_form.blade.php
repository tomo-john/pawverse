<div class="max-w-2xl mx-auto px-6 py-4">
    <div class="bg-white rounded-2xl shadow-md p-6">
        <form method="POST" action="{{ $action }}" class="space-y-5">
            @csrf
            @isset($method)
              @method($method)
            @endisset

            <!-- 名前 -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fa-solid fa-dog text-rose-500 mr-1"></i>名前
                </label>
                <input name="name"
                       x-model="name"
                       class="w-full rounded-lg border-gray-300 focus:border-pink-400 focus:ring-pink-300">
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
                        <option value="{{ $value }}">{{ $label }}</option>
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
                        <option value="{{ $value }}">{{ $label }}</option>
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
                {{ $submitText ?? '保存する' }}
            </button>
        </form>
    </div>
</div>
