<div class="bg-white rounded-2xl p-6 shadow-sm border">
    <h2 class="font-bold text-gray-700 mb-4">今日の記録(作成中)</h2>

    @if (session('error'))
        <p class="text-red-600">{{ session('error') }}</p>
    @endif

    <div class="bg-gray-400 rounded-2xl p-6 border space-y-6">
        {{-- type: ログの種類 --}}
        <flux:select label="何をした？🐶" wire:model.live="type">
            <option value="" disabled>選択してください</option>
            @foreach ($types as $key => $label)
                <option value="{{ $key }}">{{ $label }}</option>
            @endforeach
        </flux:select>

        @if ($type && $isRequiresValue)
            {{-- value: 容量 --}}
            <flux:input :label="'どのくらい？🐶' . ($unit? '(' . $unit . ')' : '')" type="number" wire:model="value" />
        @endif

        {{-- memo: メモ --}}
        <flux:input label="めも🐶" wire:model="memo" />

        {{-- logged_at: 実行日時 --}}
        <flux:input label="いつした？🐶" type="datetime-local" wire:model="logged_at" />

        {{-- 送信ボタン --}}
        <flux:button wire:click="save">記録する🐶</flux:button>
    </div>
</div>
