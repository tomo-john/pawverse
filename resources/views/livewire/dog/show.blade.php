<div class="max-w-4xl mx-auto space-y-6">

    {{-- ヘッダー --}}
    <div class="sticky top-0 z-30 flex justify-center items-center gap-6">

        {{-- Dog --}}
        <div class="relative flex justify-center items-center w-64 h-64 border-4 border-pink-100 rounded-full bg-white shadow-sm flex-shrink-0">
            <i class="fa-solid fa-dog {{ $dog->size_class }} drop-shadow-sm"
               style="color: {{ $dog->color }}"></i>
        </div>

        {{-- 吹き出し --}}
        <div class="relative bg-white border-2 border-pink-200 p-4 rounded-2xl shadow-sm">
            <div class="absolute -left-2 top-1/2 -translate-y-1/2 w-4 h-4 bg-white border-l-2 border-b-2 border-pink-200 rotate-45"></div>

            <div class="flex items-center gap-2 text-lg font-bold text-gray-700">
                <livewire:dog.dog-message :dog="$dog" />
            </div>
        </div>
    </div>

    <div class="flex items-baseline justify-center gap-3 bg-white py-2 rounded-2xl border border-pink-50">
        <div class="text-3xl">
            🐶
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

