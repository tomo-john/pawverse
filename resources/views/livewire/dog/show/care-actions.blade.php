<div class="bg-white rounded-2xl p-6 shadow-sm border">
    <h2 class="font-bold text-gray-700 mb-4">お世話</h2>

    {{-- アクションボタンエリア --}}
    <div wire:poll.1s="loadCooldowns" class="flex gap-3 text-sm text-gray-600">
        @foreach ($actions as $key => $action)
            <div class="flex flex-col gap-1 w-32">
                {{-- アクションボタン --}}
                <flux:button
                    wire:click="action('{{ $key }}')"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-50 scale-95"
                    variant="primary"
                    color="{{ $action['button-color']}}" size="sm"
                    :disabled="$this->isDisabled($key)"
                >
                <i class="{{ $action['icon'] }}"></i>
                    {{ $action['label'] }}
                </flux:button>

                {{-- クールダウン中残り時間 --}}
                @if ($this->isDisabled($key))
                    <span class="text-xs text-center {{ $action['text-color'] }}">
                        <i class="fa-solid fa-clock"></i>
                        {{ $this->cooldownFormatted($key) }}
                    </span>
                @endif
            </div>
        @endforeach
    </div>
</div>
