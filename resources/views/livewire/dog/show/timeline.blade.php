<div class="bg-white rounded-2xl p-6 shadow-sm border">

    <h2 class="font-bold text-gray-700 mb-4">タイムライン(作成中)</h2>

    @forelse ($timeline as $event)
        <div class="bg-pink-50 text-black rounded-lg my-1 p-1">
            <div class="grid grid-cols-[24px_1fr] gap-3 px-2 text-sm">

                <i class="{{ $event['icon'] }} mt-1"></i>

                <div>
                    <div>
                        {{ $event['label'] }}
                        <span class="text-gray-400 text-xs ml-2">
                            {{ $event['time']->diffForHumans() }}
                        </span>
                    </div>

                    <div class="text-gray-500 text-xs mt-1">
                        {{ implode(' / ', $event['effects']->toArray()) }}
                    </div>
                </div>

            </div>
        </div>

    @empty
        <div class="text-sm text-gray-400">
            タイムラインはまだありません🐶
        </div>
    @endforelse

</div>
