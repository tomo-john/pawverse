<div class="max-w-6xl mx-auto flex gap-6">

    {{-- 左側: 犬専用レーン --}}
    <div class="w-32 relative">
        <div class="sticky top-10 flex flex-col justify-center">
            {{-- Dog --}}
            <div class="relative w-24 h-24" wire:poll.500ms="checkAnimation">
                <i class="fa-solid fa-dog {{ $dog->size_class }} hover:scale-110 transition
                          {{ $activeAnimation === 'walk' ? 'dog-walk' : '' }}"
                   style="color: {{ $dog->color }}"></i>
            </div>
        </div>
    </div>

    {{-- 右側: Showコンテンツ --}}
    <div class="flex-1 space-y-6">

        <div class="max-w-4xl mx-auto space-y-6">
        <flux:button wire:click="startAnimation('walk', 5)">test</flux:button>

            {{-- 名前とis_public --}}
            <div class="flex items-baseline justify-center gap-3 bg-white py-2 rounded-2xl border border-pink-50">
                <div class="text-3xl">
                    <i class="fa-solid fa-dog" style="color: {{ $dog->color }}"></i>
                </div>
                <span class="text-gray-500 text-sm italic">My Name is...</span>
                <span class="text-2xl font-black text-pink-600 tracking-wider">{{ $dog->name }}</span>

                <span class="{{ $dog->public_visibility['class'] }} text-[10px] font-bold uppercase tracking-tighter rounded-full shadow-sm px-2 py-0.5 border border-white">
                    {{ $dog->public_visibility['label'] }}
                </span>
            </div>

            {{-- statau-panel: ステータス表示エリア　--}}
            <livewire:dog.show.status-panel :dog="$dog" />

            {{-- real-dog-card: リアルわんこ情報エリア　--}}
            <livewire:dog.show.real-dog-card :dog="$dog" />

            {{-- care-actions: お世話エリア(DogAction)　--}}
            <livewire:dog.show.care-actions :dog="$dog" />

            {{-- activity-form: 現実行動入力フォーム(RealDogActivity)　--}}
            <livewire:dog.show.activity-form :dog="$dog" />

            {{-- timeline: タイムライン　--}}
            <livewire:dog.show.timeline :dog="$dog" />

        </div>

    </div>

</div>
