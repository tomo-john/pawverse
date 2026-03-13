<div class="bg-white rounded-2xl p-6 shadow-sm border space-y-6">
    <h2 class="font-bold text-gray-700 mb-4">ステータス</h2>

    {{-- Level --}}
    <div class="text-center">
        <div class="text-xs text-gray-400">LEVEL</div>
        <div class="text-3xl font-bold text-indigo-600">
            {{ $dog->status->level }}
        </div>
    </div>

    {{-- EXP --}}
    <div class="flex items-center gap-4 text-md text-gray-600">
        <div>EXP : {{ $dog->status->exp }}</div>
        <div class="text-xs">次のレベルまでxx</div>
    </div>

    {{-- Status Bars --}}
    @foreach ($bars as $key => $def)
        <div class="space-y-2">
            <div class="flex justify-between text-xs text-gray-600">
                <span>{{ $def['bars']['label'] }}</span>
                <span>{{ $def['value'] }} / {{ $def['max'] }}</span>
            </div>

            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="{{ $def['bars']['color']}} h-2 rounded-full transition-all duration-500" style="width: {{ $def['percent'] }}%"></div>
            </div>
        </div>
    @endforeach
</div>
