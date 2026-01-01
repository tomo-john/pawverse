<!-- 名前 -->
<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">
        <i class="fa-solid fa-dog text-rose-500 mr-1"></i>名前
    </label>
    <input name="name"
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
    <input name="color"
           class="w-full rounded-lg border-gray-300 focus:border-pink-400 focus:ring-pink-300"
           value="{{ old('color', $dog->color) }}">
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
            class="w-full rounded-lg border-gray-300 focus:border-pink-400 focus:ring-pink-300">
              @foreach($sizes as $value => $label)
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
    {{ $submitText ?? '保存する' }}
</button>
