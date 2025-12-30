<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            犬を登録する 🐶
        </h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('dogs.store') }}">
            @csrf

            <div>
                <label>名前</label>
                <input name="name" class="border" />
            </div>

            <div>
                <label>毛色</label>
                <input name="color" class="border" />
            </div>

            <div>
                <label>サイズ</label>
                <select name="size" class="border">
                    <option value="small">small</option>
                    <option value="medium">medium</option>
                    <option value="large">large</option>
                </select>
            </div>

            <div>
                <label>
                    <input type="checkbox" name="is_public" value="1">
                    公開する
                </label>
            </div>

            <button class="mt-4 bg-blue-500 text-white px-4 py-2">
                登録
            </button>
        </form>
    </div>
</x-app-layout>
