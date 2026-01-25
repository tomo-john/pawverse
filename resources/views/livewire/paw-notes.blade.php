<div class="max-w-xl mx-auto space-y-6">
    <div class="bg-white rounded-xl shadow p-4 space-y-3">
        <h2 class="font-semibold text-lg">
            <i class="fa-solid fa-paw"></i>
            Paw Note
        </h2>
        <textarea
            wire:model.defer="body"
            class="w-full rounded-lg border-gray-300 focus:border-pink-400 focus:ring-pink-300"
            rows="3"
            placeholder="ひとことメモを書くワン..."
        ></textarea>

        @error('body')
            <p class="text-sm text-red-500">{{ $message }}</p>
        @enderror

        <div wire:loading class="text-sm text-gray-500">
            処理中です...
            <i class="fa-solid fa-gear"></i>
        </div>

        <button wire:click="save"
                class="block px-4 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600 transtion"
        >
            SAVE
        </button>
    </div>
</div>
