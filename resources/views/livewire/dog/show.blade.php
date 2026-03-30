<div class="max-w-6xl mx-auto flex gap-6">

    {{-- 左側: 犬専用レーン --}}
    <div class="w-32 flex justify-center"
         x-data="{
            y: 0,
            targetY: 0,
            isMoving: false,
            isReacting: false,
            scrollTimer: null,
            mouseTimer: null
         }"

         @dog-reacted.window="
            isReacting = true;
            isMoving = false;

            setTimeout(() => {
                isReacting = false;

                setTimeout(() => {
                    y = targetY;
                }, 50);

            }, $event.detail.duration * 1000)
         "
         @mousemove.window="
            targetY = $event.clientY;

            if (isReacting) return;

            isMoving = true,
            clearTimeout(mouseTimer);
            mouseTimer = setTimeout(() => isMoving = false, 100);
            y = targetY;
         "
         @scroll.window="
            if (isReacting) return;

            isMoving = true,
            clearTimeout(scrollTimer);
            scrollTimer = setTimeout(() => isMoving = false, 200);
         "
    >
            {{-- Dog --}}
            <div class="relative w-24 h-24 flex justify-center items-center"
                 wire:poll.1s="checkAnimation"
                 :style="`position: fixed; top: ${y}px; transform: translateY(-50%); transition: top 2.5s cubic-bezier(0.22, 1, 0.36, 1)`"
            >
                <i class="fa-solid fa-dog {{ $dog->size_class }} hover:scale-110 transition {{ $this->animationClass }}"
                   :class="{ 'dog-follow' : isMoving }"
                   style="color: {{ $dog->color }}"
                ></i>
            </div>
    </div>

    {{-- 右側: Showコンテンツ --}}
    <div class="flex-1 space-y-6">

        <div class="max-w-4xl mx-auto space-y-6">
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
