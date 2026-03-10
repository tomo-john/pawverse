<div class="bg-white rounded-2xl p-6 shadow-sm border">

    <h2 class="font-bold text-gray-700 mb-4">タイムライン(作成中)</h2>

    @forelse ($timeline as $event)
        <div class="text-sm text-black">
            {{ $event['time'] }}
            {{ $event['label'] }}
            <i class="{{ $event['icon'] }}"></i>

            @foreach ($event['effects'] as $effect)
                {{ $effect }}
            @endforeach

        </div>
    @empty
        <div class="text-sm text-gray-400">
            タイムラインはまだありません🐶
        </div>
    @endforelse

</div>
