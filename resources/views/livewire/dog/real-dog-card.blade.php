<div class="bg-white rounded-2xl p-6 shadow-sm border">
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-bold text-gray-700 mb-4">
            リアルわんこ情報
        </h2>

        @if ($dog->realDog)
            <flux:badge rounded variant="solid" icon="link" color="green">リンク済み</flux:badge>
        @endif
    </div>

    <div class="flex items-start gap-6">
        {{-- 画像 --}}
        <div class="relative">
            <img src="{{ $dog->realDog?->photo_url ?? asset('images/dogs/dog_default.jpg') }}"
                 class="w-32 h-32 object-cover rounded-full border shadow-sm"
            >
            @if ($dog->realDog?->photo_path)
                <div class="absolute bottom-1 right-1">
                <flux:button size="xs" icon="trash" wire:click="removePhoto" wire:target="removePhoto" wire:confirm="写真を初期状態に戻しますか？🐶"
                             class="shadow cursor-pointer">
                </flux:button>
                </div>
            @endif
        </div>

        {{-- 情報 --}}
        @if ($dog->realDog)
            <div class="flex-1 grid grid-cols-2 gap-x-6 gap-y-3 text-sm text-gray-600">
                <div>
                    <span class="text-xs text-gray-400 block">犬種</span>
                    {{ $dog->realDog->breed ?? '未登録' }}
                </div>

                <div>
                    <span class="text-xs text-gray-400 block">性別</span>
                    {{ $dog->realDog->sex_label }}
                </div>

                <div>
                    <span class="text-xs text-gray-400 block">性格</span>
                    {{ $dog->realDog->personality_label }}
                </div>

                <div>
                    <span class="text-xs text-gray-400 block">誕生日</span>
                    {{ $dog->realDog->birthday?->format('Y年n月j日') ?? '未登録' }}
                    {{ $dog->realDog->age !== null ? ' (' . $dog->realDog->age . ' 才)' : '' }}
                </div>
            </div>
        @else
            <div class="flex items-center text-sm text-gray-500">
                まだ現実のわんことリンクされていません
            </div>
        @endif
    </div>

    <div class="mt-6">
        <flux:button variant="primary" wire:click="openModal" color="pink">
            {{ $dog->realDog ? '編集する' : 'リンクする' }}
        </flux:button>
    </div>

    {{-- モーダル --}}
    <flux:modal wire:model="showModal">
        <div class="space-y-4">

            <flux:heading size="md">
                リアルわんこ情報
            </flux:heading>

            <flux:input label="犬種" wire:model="breed" />

            <flux:select label="性別" wire:model="sex">
                <option value="">未登録</option>
                <option value="male">オス</option>
                <option value="female">メス</option>
            </flux:select>

            <flux:select label="性格" wire:model="personality">
                <option value="">未登録</option>
                @foreach ($personalities as $key => $label)
                    <option value="{{ $key }}">{{ $label }}</option>
                @endforeach
            </flux:select>

            <flux:input label="誕生日" wire:model="birthday" type="date" />

            <flux:input label="写真" wire:model="photo" type="file" />

            <div class="flex justify-end gap-3">
                <flux:button variant="ghost" wire:click="closeModal">キャンセル</flux:button>
                <flux:button variant="primary" wire:click="save">保存</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
