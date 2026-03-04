<div class="bg-white rounded-2xl p-6 shadow-sm border">
    <h2 class="font-bold text-gray-700 mb-4">リアルログ入力(作成中)</h2>

    @if (session('error'))
        <p class="text-red-600">{{ session('error') }}</p>
    @endif

    <div class="bg-gray-400 rounded-2xl p-6 border space-y-6">
        {{-- type: ログの種類 --}}
        <flux:select label="ログの種類" wire:model.live="type">
            <option value="" disabled>選択してください</option>
            @foreach ($types as $key => $label)
                <option value="{{ $key }}">{{ $label }}</option>
            @endforeach
        </flux:select>

        {{-- value: 容量 --}}
        <flux:input label="どのくらい？" type="number" wire:model="value" />

        {{-- unit: 単位 --}}
        <flux:input label="単位" wire:model="unit" readonly />

        {{-- memo: メモ --}}
        <flux:input label="メモ" wire:model="memo" />

        {{-- logged_at: 実行日時 --}}
        <flux:input label="実行日時" type="datetime-local" wire:model="logged_at" />

        {{-- 送信ボタン --}}
        <flux:button wire:click="save">保存</flux:button>
    </div>
</div>
