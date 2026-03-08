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

    {{-- Happy --}}
    <div class="space-y-2">
        <div class="flex justify-between text-xs text-gray-600">
            <span>Happy</span>
            <span>{{ $dog->status->happy }} / 100</span>
        </div>

        <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-pink-400 h-2 rounded-full transition-all duration-500" style="width: {{ $dog->status->happy }}%"></div>
        </div>
    </div>

    {{-- Stamina --}}
    <div class="space-y-2">
        <div class="flex justify-between text-xs text-gray-600">
            <span>Stamina</span>
            <span>{{ $dog->status->stamina }} / 100</span>
        </div>

        <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-green-400 h-2 rounded-full transition-all duration-500" style="width: {{ $dog->status->stamina }}%"></div>
        </div>
    </div>

    {{-- Hunger --}}
    <div class="space-y-2">
        <div class="flex justify-between text-xs text-gray-600">
            <span>Hunger</span>
            <span>{{ $dog->status->hunger }} / 100</span>
        </div>

        <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-yellow-400 h-2 rounded-full transition-all duration-500" style="width: {{ $dog->status->hunger }}%"></div>
        </div>
    </div>

</div>
