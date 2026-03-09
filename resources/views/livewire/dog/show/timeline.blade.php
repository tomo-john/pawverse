<div class="bg-white rounded-2xl p-6 shadow-sm border">
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-bold text-gray-700 mb-4">
            タイムライン
        </h2>
    </div>

    <div class="text-black">
        @foreach ($timeline as $line)
            <p>Time: {{ $line['time'] }}</p>
            <p>Source(action): {{ $line['source']['action'] }}</p>

            @foreach( $line['effects'] as $effect)
                <p>Effect: {{ $effect['status'] }} / {{ $effect['delta'] }}</p>
            @endforeach
            <hr/>
        @endforeach
    </div>
</div>
