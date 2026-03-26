<div class="p-6 m-6 bg-white rounded-xl shadow border border-gray-100"
     x-data="{ name: '' }"
>

    <div class="text-center space-y-4">
        {{-- ワンコのアイコン --}}
        <div class="text-5xl text-blue-500">
            <i class="fa-solid fa-dog"></i>
        </div>

        {{-- 名札 --}}
        <div class="text-xl font-bold text-blue-600">
            <span x-text="name || '名無しのじょん'"></span>
        </div>

        {{-- フォーム --}}
        <div class="max-w-xl mx-auto text-black">
            <input type="text"
                   x-model="name"
                   placeholder="名前を入力"
                   class="w-full border-2 border-blue-200 rounded-lg p-2
                          focus:border-blue-400 outline-none"
            >
        </div>

    </div>
</div>
