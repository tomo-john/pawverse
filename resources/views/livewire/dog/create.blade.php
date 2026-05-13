<div x-data="{ overrideMessage: '' }"
     x-on:message.window="overrideMessage = $event.detail.text"
     x-on:message-clear="overrideMessage = ''"
     class="max-w-3xl mx-auto flex flex-col gap-3"
>

    {{-- Dog Area --}}
    <div class="relative flex flex-col items-center gap-2 h-84">
        {{-- 犬小屋・犬・表札 --}}
        <i class="{{ $this->houseClasses }}"></i>
        <i class="{{ $this->dogClasses }}" style="color: {{ $color }}"></i>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 translate-y-5
                    px-3 py-1 text-xs rounded-full bg-white/90 backdrop-blur border border-pink-100 text-slate-500 shadow whitespace-nowrap">
            {{ Str::limit($name ? $name : '...', 12) }}
        </div>

        {{-- おもちゃ --}}
        @foreach($this->worldItems as $item)
            <div @class([
                 'absolute text-2xl transition-all duration-700', $item['icon'], $item['pos'],
                 'opacity-0 scale-10' => $step < $item['step'],
                 'opacity-100 scale-100 animate-pulse' => $step >= $item['step'],
                 'text-gray-300 animate-pulse' => $step < 5,
                 'drop-shadow-sm ' . $item['active_color'] => $step === 5,
            ])
            >
            </div>
        @endforeach

        {{-- 公開/非公開アイコン --}}
        <i class="{{ $this->publicIconClasses }}"></i>
    </div>

    {{-- Console Message --}}
    <div class="w-full bg-gray-100/80 border-4 border-gray-400 p-4 rounded-lg shadow-inner mt-2"
         x-transition.opacity.duration.500ms
    >
        <div class="flex items-center gap-3 animate-pulse">
            <i class="fa-solid fa-circle-question text-gray-400"></i>
            <p x-text="overrideMessage || @js($this->consoleMessage)" class="text-gray-500 font-bold text-sm"></p>
        </div>
    </div>

    {{-- Form --}}
    @if($step === 1)
        <div class="flex flex-col items-center justify-center gap-3">
            <input wire:model.live="name"
                   class="max-w-2xl px-2 py-2 cursor-pointer rounded-2xl bg-pink-50/50 border-2 border-pink-100 focus:border-pink-400 focus:ring-2 focus:ring-pink-200 outline-none transition"
            >
            <div class="text-sm text-slate-500">
                あのこの名前({{ mb_strlen($name) }} / 20文字)
            </div>
        </div>
    @endif

    @if($step === 2)
        <div class="flex flex-col items-center justify-center gap-3 relative">
            <input id="dog-color"
                   type="color"
                   wire:model.live="color"
                   class="absolute w-12 h-12 cursor-pointer opacity-0 cursor-pointer z-10">
            <div class="w-12 h-12 rounded-full border-2 border-white shadow overflow-hidden">
                <div class="w-full h-full"
                     style="background-color: {{ $color }}">
                </div>
            </div>
            <div class="text-sm text-slate-500">
                @if(!$this->hasCustomColor)
                    あのこの毛色
                @else
                    こんな色だった気がするわん
                @endif
            </div>
        </div>
    @endif

    @if($step === 3)
        <div class="flex flex-col items-center justify-center gap-3">
            <input type="range"
                   min="1"
                   max="9"
                   step="1"
                   wire:model.live="size_level"
                   class="w-64 accent-pink-300 cursor-pointer bg-pink-100 rounded-lg">

            <div class="text-sm text-slate-500">
                @if(!$this->hasCustomSize)
                    あの子の大きさ
                @else
                    これくらいの大きさだったかな？
                @endif
            </div>
        </div>
    @endif

    @if($step === 4)
        <div class="flex flex-col items-center justify-center gap-4">
            <div class="flex gap-4">
                <button type="button"
                        wire:click="$set('is_public', true)"
                        @class([
                            'px-4 py-2 rounded-2xl font-bold transition-all duration-300 border-2',
                            'bg-pink-500 text-white border-pink-500 shadow-lg scale-105' => $is_public === true,
                            'bg-white text-pink-500 border-pink-200 hover:border-pink-300' => $is_public !== true
                        ])
                >
                    はい
                </button>
                <button type="button"
                        wire:click="$set('is_public', false)"
                        @class([
                            'px-4 py-2 rounded-2xl font-bold transition-all duration-300 border-2',
                            'bg-slate-600 text-white border-slate-600 shadow-lg scale-105' => $is_public === false,
                            'bg-white text-slate-500 border-slate-200 hover:border-slate-300' => $is_public !== false
                        ])
                >
                    いいえ
                </button>
            </div>
            <div class="text-sm text-slate-500">
                @if(is_null($is_public))
                    どちらか選んでね
                @elseif($is_public === true)
                    みんなに見てもらうわん!
                @elseif($is_public === false)
                    お家が一番なんだわん
                @endif
            </div>
        </div>
    @endif

    @if($step === 5 && $this->canSave)
        <div class="flex items-center justify-center">
            <button type = "button"
                    wire:click="save"
                    class="w-fit px-4 py-2 rounded-2xl font-bold cursor-pointer transition-all duration-300 border-2
                           bg-slate-300 text-white shadow-lg hover:bg-pink-400 hover:scale-105"
            >
                迎えいれる
            </button>
        </div>
    @endif

    {{-- 進行ボタン --}}
    <div class="flex items-center justify-center gap-4 text-2xl">
        @if($step === 0)
            <button wire:click="nextStep" class="cursor-pointer text-gray-400 flex items-center gap-2 hover:text-gray-600 mt-6">
                <span class="text-sm animate-pulse">はじめる</span>
            </button>
        @endif

        @if($step >= 2)
            <button wire:click="prevStep" class="cursor-pointer"><i class="fa-regular fa-circle-left"></i></button>
        @endif

        @if($step >= 1 && $step < 5)
            <button wire:click="nextStep" class="cursor-pointer"><i class="fa-regular fa-circle-right"></i></button>
        @endif
    </div>

</div>
