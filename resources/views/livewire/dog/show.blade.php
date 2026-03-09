<div class="max-w-4xl mx-auto space-y-6">

    {{-- ヘッダー --}}
    <div class="flex items-center gap-6">

        <div class="relative flex justify-center items-center w-48 h-48 border-4 border-pink-100 rounded-full bg-white shadow-sm flex-shrink-0">

            {{-- Public Badge --}}
            <div class="absolute bottom-1 right-1">
                <span class="{{ $dog->public_visibility['class'] }} text-xs rounded-full shadow px-2 py-1">
                    {{ $dog->public_visibility['label'] }}
                </span>
            </div>

            {{-- Dog --}}
            <i class="fa-solid fa-dog {{ $dog->size_class }} drop-shadow-sm"
               style="color: {{ $dog->color }}"></i>
        </div>

        {{-- 吹き出し --}}
        <div class="relative bg-white border-2 border-pink-200 p-4 rounded-2xl shadow-sm">
            <div class="absolute -left-2 top-1/2 -translate-y-1/2 w-4 h-4 bg-white border-l-2 border-b-2 border-pink-200 rotate-45"></div>

            <div class="flex items-center gap-2 text-lg font-bold text-gray-700">

                {{-- 吹き出しのセリフ --}}
                <i class="fa-solid fa-paw text-pink-400"></i>
                <span>ボクの名前は <span class="text-pink-600">{{ $dog->name }}</span> だわん！</span>
            </div>
        </div>

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

