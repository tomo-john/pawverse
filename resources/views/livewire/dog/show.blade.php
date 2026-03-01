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

    {{-- ステータス --}}
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

    {{-- リアルわんこ --}}
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
    </div>

    {{-- お世話(アクション) --}}
    <div class="bg-white rounded-2xl p-6 shadow-sm border">
        <h2 class="font-bold text-gray-700 mb-4">お世話</h2>

        {{-- リアクションDog --}}
        <div class="my-2">
            <i class="fa-solid fa-dog text-3xl drop-shadow-sm" style="color: {{ $dog->color }}"></i>
        </div>

        {{-- アクションボタンエリア --}}
        <div wire:poll.1s="loadCooldowns" class="flex gap-3 text-sm text-gray-600">
            {{-- 散歩 --}}
            <div class="flex flex-col gap-1 w-32">
                <flux:button
                    wire:click="action('walk')"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-50 scale-95"
                    variant="primary"
                    color="sky" size="sm"
                    :disabled="$this->isDisabled('walk')"
                >
                    散歩
                </flux:button>
                @if ($this->isDisabled('walk'))
                    <span class="text-xs text-gray-400 text-center">
                        <i class="fa-solid fa-clock"></i>
                        {{ $this->cooldownFormatted('walk') }}
                    </span>
                @endif
            </div>

            {{-- おやつ --}}
            <div class="flex flex-col gap-1 w-32">
                <flux:button
                    wire:click="action('snack')"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-50 scale-95"
                    variant="primary"
                    color="green" size="sm"
                    :disabled="$this->isDisabled('snack')"
                >
                    おやつ
                </flux:button>
                @if ($this->isDisabled('snack'))
                    <span class="text-xs text-gray-400 text-center">
                        <i class="fa-solid fa-clock"></i>
                        {{ $this->cooldownFormatted('snack') }}
                    </span>
                @endif
            </div>

            {{-- ごはん --}}
            <div class="flex flex-col gap-1 w-32">
                <flux:button
                    wire:click="action('meal')"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-50 scale-95"
                    variant="primary"
                    color="pink" size="sm"
                    :disabled="$this->isDisabled('meal')"
                >
                    ごはん
                </flux:button>
                @if ($this->isDisabled('meal'))
                    <span class="text-xs text-gray-400 text-center">
                        <i class="fa-solid fa-clock"></i>
                        {{ $this->cooldownFormatted('meal') }}
                    </span>
                @endif
            </div>
        </div>
    </div>

    {{-- ログ --}}
    <div class="bg-white rounded-2xl p-6 shadow-sm border">
        <h2 class="font-bold text-gray-700 mb-4">アクション履歴</h2>

        @if ($Logs->isNotEmpty())
            <div class="h-80 overflow-y-auto space-y-3 pr-6 text-sm text-gray-600">
                @foreach($Logs as $log)

                    <div class="border rounded-xl p-4 {{ $log->definition['bg'] }}">

                        <div class="flex items-center justify-between text-xs text-gray-400">
                            <div class="flex items-center gap-2 {{ $log->definition['color'] }}">
                                <i class="{{ $log->definition['icon'] }}"></i>
                                <span>{{ $log->definition['label'] }}</span>
                            </div>

                            <span>{{ $log->created_at->diffForHumans() }}</span>
                        </div>

                        <div class="text-sm text-gray-700 mt-2">
                            Lv {{ $log->payload['before']['level'] }}
                            <i class="fa-solid fa-circle-right mx-1 text-gray-700"></i>
                            Lv {{ $log->payload['after']['level'] }}
                        </div>
                        <div class="mt-2 flex flex-wrap gap-2 text-xs">
                            @foreach($log->payload['effects'] as $key => $value)
                                <span class="px-2 py-1 rounded-full bg-white/60">
                                    {{ ucfirst($key) }}
                                    {{ $value > 0 ? '+' : '' }}{{ $value }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $Logs->links(data: ['scrollTo' => false]) }}
            </div>
        @else
            <div class="text-sm text-gray-600">
                <p>
                    まだアクションログがありません
                    <i class="fa-solid fa-dog mx-1"></i>
                </p>
            </div>
        @endif

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

