<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            犬を編集する 🐶
        </h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('dogs.update', $dog) }}">
            @csrf
            @method('PUT')

            <div>
                <label>名前</label>
                <input name="name" value="{{ old('name', $dog->name) }}" class="border">
            </div>

            <div>
                <label>毛色</label>
                <input name="color" value="{{ old('color', $dog->color) }}" class="border">
            </div>

            <div>
                <label>サイズ</label>
                <select name="size" class="border">
                    @foreach($sizes as $value => $label)
                        <option value="{{ $value }}"
                            @selected(old('size', $dog->size) === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>
                    <input type="checkbox" name="is_public" value="1"
                        @checked(old('is_public', $dog->is_public))>
                    公開する
                </label>
            </div>

            <button class="mt-4 bg-blue-500 text-white px-4 py-2">
                更新
            </button>
        </form>
    </div>
</x-app-layout>
