<div class="bg-white rounded-2xl p-6 shadow-sm border">
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-bold text-gray-700 mb-4">
            タイムライン
        </h2>
    </div>

    <div class="relative border-l border-gray-200 ml-3">

        @foreach ($timeline as $event)

            <div class="mb-6 ml-6">

                {{-- timeline dot --}}
                <span class="absolute -left-3 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-4 ring-white">
                    🐾
                </span>

                {{-- header --}}
                <div class="flex items-center gap-3">

                    <p class="text-sm text-gray-500">
                        {{ $event['time']->diffForHumans() }}
                    </p>

                    <p class="font-semibold text-gray-800">
                        {{ $event['source']['action'] ?? '-' }}
                    </p>

                </div>

                {{-- effects --}}
                <div class="mt-2 ml-2 text-sm text-gray-600 space-y-1">

                    @foreach ($event['effects'] as $effect)

                        <div>
                            {{ $effect['status'] }}
                            <span class="font-medium">
                                {{ $effect['delta'] > 0 ? '+' : '' }}{{ $effect['delta'] }}
                            </span>
                        </div>

                    @endforeach

                </div>

            </div>

        @endforeach

    </div>

</div>
