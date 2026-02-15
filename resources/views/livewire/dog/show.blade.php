<div class="max-w-4xl mx-auto space-y-6">

    {{-- ヘッダー --}}
    <div class="flex items-center gap-6">

        <div class="flex justify-center items-center w-48 h-48 border-4 border-pink-100 rounded-full bg-white shadow-sm flex-shrink-0">
            <i class="fa-solid fa-dog {{ $dog->size_class }} drop-shadow-sm"
               style="color: {{ $dog->color }}">
            </i>
        </div>

        <div class="relative bg-white border-2 border-pink-200 p-4 rounded-2xl shadow-sm">
            <div class="absolute -left-2 top-1/2 -translate-y-1/2 w-4 h-4 bg-white border-l-2 border-b-2 border-pink-200 rotate-45"></div>

            <div class="relative flex items-center gap-2 text-lg font-bold text-gray-700">
                <i class="fa-solid fa-paw text-pink-400"></i>
                <span>ボクの名前は <span class="text-pink-600">{{ $dog->name }}</span> だわん！</span>
            </div>
        </div>

    </div>

    {{-- ステータス --}}
    <div class="bg-white rounded-2xl p-6 shadow-sm border">
        <h2 class="font-bold text-gray-700 mb-4">ステータス</h2>

        <div class="space-y-2 text-sm text-gray-600">
            <div>Level : 1</div>
            <div>EXP : 0</div>
            <div>Happy : 50</div>
        </div>
    </div>

    {{-- リアルわんこ --}}
    <div class="bg-white rounded-2xl p-6 shadow-sm border">
        <h2 class="font-bold text-gray-700 mb-4">リアルわんこ情報</h2>

        @if ($dog->realDog)
            <p class="text-green-500 text-sm my-2">
                リンク済み
            </p>
            <div class="space-y-2 text-sm text-gray-600 my-2">
                <div>犬種 : {{ $breed ?? '未登録' }}</div>
                <div>性別 : {{ $sex ?? '未登録' }}</div>
                <div>性格 : {{ $personality ?? '未登録' }}</div>
            </div>
            <flux:button variant="primary" wire:click="openModal" color="pink">
                編集する
            </flux:button>
        @else
            <p class="text-gray-500 text-sm my-2">
                まだ現実のわんことリンクされていません
            </p>

            <flux:button variant="primary" wire:click="openModal" color="pink">
                リンクする
            </flux:button>
        @endif
    </div>

    {{-- アクション --}}
    <div class="bg-white rounded-2xl p-6 shadow-sm border">
        <h2 class="font-bold text-gray-700 mb-4">できること</h2>

        <div class="flex gap-3 text-sm text-gray-600">
            <button class="px-3 py-1 bg-blue-100 rounded-lg">散歩</button>
            <button class="px-3 py-1 bg-yellow-100 rounded-lg">ごはん</button>
            <button class="px-3 py-1 bg-green-100 rounded-lg">なでる</button>
        </div>
    </div>

    {{-- モーダル --}}
    <flux:modal wire:model="showModal">
        <div class="space-y-4">

            <flux:heading size="md">
                リアルわんこ情報
            </flux:heading>

            <flux:input label="犬種" wire:model="breed" />

            <flux:input label="性別" wire:model="sex" />

            <flux:input label="性格" wire:model="personality" />

            <div class="flex justify-end gap-3">
                <flux:button variant="ghost" wire:click="closeModal">キャンセル</flux:button>
                <flux:button variant="primary" wire:click="save">保存</flux:button>
            </div>
        </div>
    </flux:modal>

</div>

