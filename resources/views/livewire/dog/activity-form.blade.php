<div class="bg-white rounded-2xl p-6 shadow-sm border">
    <h2 class="font-bold text-gray-700 mb-4">今日の記録(作成中)</h2>

    @if (! $hasRealDog)
        <div class="text-sm text-gray-400">
            リアルわんこ情報を登録すると活動を記録できます🐶
        </div>
    @else
        @if (session('error'))
            <div class="text-red-600 mb-4">{{ session('error') }}</div>
        @endif

        @if (session('message'))
            <div class="text-green-600 mb-4">{{ session('message') }}</div>
        @endif

        <div class="bg-black rounded-2xl p-6 border space-y-6">
            {{-- type: 記録の種類 --}}
            <flux:select label="何をした？🐶" wire:model.live="type">
                <option value="" disabled>選択してください</option>
                @foreach ($types as $key => $label)
                    <option value="{{ $key }}">{{ $label }}</option>
                @endforeach
            </flux:select>

            @if ($type && $requiresValue)
                {{-- value: どのくらい --}}
                <flux:input :label="'どのくらい？🐶' . ($unit ? ' (' . $unit . ')' : '')"
                            type="number"
                            wire:model="value"
                            min="1"
                            placeholder="最大値: {{ $maxValue }}"
                />
            @endif

            {{-- memo: メモ --}}
            <flux:input label="めも🐶" wire:model="memo" />

            {{-- logged_at: 実行日時 --}}
            <flux:input label="いつした？🐶" type="datetime-local" wire:model="logged_at" />

            {{-- 送信ボタン --}}
            <flux:button wire:click="save" wire:loading.attr="disabled">記録する🐶</flux:button>
        </div>
    @endif
</div>
