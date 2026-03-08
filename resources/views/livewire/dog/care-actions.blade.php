<div class="bg-white rounded-2xl p-6 shadow-sm border">
    <h2 class="font-bold text-gray-700 mb-4">お世話</h2>

    {{-- リアクションDog --}}
    <div class="my-2">
        <i class="fa-solid fa-dog text-3xl drop-shadow-sm"
           style="color: {{ $dog->color }}"></i>
    </div>

    {{-- アクションボタンエリア --}}
    <div wire:poll.1s="loadCooldowns" class="flex gap-3 text-sm text-gray-600">
        @foreach ($actions as $action)
            {{ $action['label'] }}
        @endforeach
    </div>


    {{-- アクションボタンエリア --}}
    <div wire:poll.1s="loadCooldowns" class="flex gap-3 text-sm text-gray-600">
        <div class="flex flex-col gap-1 w-32">
            <flux:button
                wire:click="action('pet')"
                wire:loading.attr="disabled"
                wire:loading.class="opacity-50 scale-95"
                variant="primary"
                color="sky" size="sm"
                :disabled="$this->isDisabled('pet')"
            >
                なでる
            </flux:button>
            @if ($this->isDisabled('pet'))
                <span class="text-xs text-gray-400 text-center">
                    <i class="fa-solid fa-clock"></i>
                    {{ $this->cooldownFormatted('pet') }}
                </span>
            @endif
        </div>

        <div class="flex flex-col gap-1 w-32">
            <flux:button
                wire:click="action('snack')"
                wire:loading.attr="disabled"
                wire:loading.class="opacity-50 scale-95"
                variant="primary"
                color="green" size="sm"
                :disabled="$this->isDisabled('snack')"
            >
                おやつ
            </flux:button>
            @if ($this->isDisabled('snack'))
                <span class="text-xs text-gray-400 text-center">
                    <i class="fa-solid fa-clock"></i>
                    {{ $this->cooldownFormatted('snack') }}
                </span>
            @endif
        </div>

        <div class="flex flex-col gap-1 w-32">
            <flux:button
                wire:click="action('scold')"
                wire:loading.attr="disabled"
                wire:loading.class="opacity-50 scale-95"
                variant="primary"
                color="red" size="sm"
                :disabled="$this->isDisabled('scold')"
            >
                しかる
            </flux:button>
            @if ($this->isDisabled('scold'))
                <span class="text-xs text-gray-400 text-center">
                    <i class="fa-solid fa-clock"></i>
                    {{ $this->cooldownFormatted('scold') }}
                </span>
            @endif
        </div>
    </div>
</div>
