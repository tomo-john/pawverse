<div id="dog-form"
     @class([
        'max-w-xl mx-auto space-y-5 p-6 rounded-2xl bg-white/80 backdrop-blur-md
         border border-pink-100 shadow-lg shadow-pink-100/40 transition-all duration-300 hover:animate-shadow-xl',
        'ring-2 ring-pink-300 scale-[1.01]' => $editingId,
     ])
>

    <div class="text-sm font-medium text-slate-500 flex items-center gap-2">
        <i class="fa-solid fa-paw text-pink-300"></i>
        <span>
            この子のこと、教えてほしいわん
        </span>

        @if ($this->editingId)
            <span class="text-pink-400 flex items-center gap-1 ml-2">
                <i class="fa-solid fa-dog mx-1"></i>
                お色直し中だわん
                <i class="fa-solid fa-dog mx-1"></i>
            </span>
        @endif
    </div>

    {{-- name --}}
    <div class="space-y-1">
        <label class="text-sm font-medium text-slate-500" for="dog-name">名前</label>
        <input id="dog-name"
               label="名前"
               placeholder="どんな名前がいいかな..."
               wire:model.live="name"
               class="w-full px-2 py-2 rounded-2xl bg-pink-50/50 border-2 border-pink-100 focus:border-pink-400 focus:ring-2 focus:ring-pink-200 outline-none transition"
        >
    </div>

    {{-- color --}}
    <div class="flex items-center gap-3 relative">
        <input id="dog-color"
               type="color"
               wire:model.live="color"
               class="absolute w-12 h-12 opacity-0 cursor-pointer z-10">

        <div class="w-12 h-12 rounded-full border-2 border-white shadow overflow-hidden">
            <div class="w-full h-full"
                 style="background-color: {{ $color }}">
            </div>
        </div>

        <div class="text-sm text-slate-500">
            この子の毛色だわん
            <div class="text-xs">{{ $color }}</div>
        </div>
    </div>

    {{-- size --}}
    <div class="space-y-1">
        <label class="text-sm font-medium">大きさ</label>

        <input type="range"
               min="1"
               max="9"
               step="1"
               wire:model.live="size_level"
               class="w-full">

        <div class="text-sm text-slate-500">
            {{
                $size_level < 3 ? '小さめだわん' :
                    ($size_level < 7 ? 'いい感じの大きさだわん' :
                    '大きいわん！頼もしいわん')
            }}
        </div>
    </div>

    {{-- is_public --}}
    <label class="flex items-center gap-2 cursor-pointer">
        <input type="checkbox"
               wire:model="is_public"
               class="w-4 h-4 accent-pink-500"
        >
        <span class="text-sm text-slate-500 font-medium">
            みんなにも会わせてあげる？
        </span>
    </label>

    {{-- button --}}
    <div class="flex gap-4 pt-2">
        <button
            wire:click="save"
            class="flex-1 text-sm py-2 rounded-2xl bg-pink-400 text-white font-bold shadow-lg shadow-pink-200 transition-all duration-200
                   hover:bg-pink-400 hover:scale-[1.05] active:scale-95"
        >
            {{ $this->editingId ? 'この子をもっと素敵にする' : 'この子を迎える' }}
        </button>

        <button
            wire:click="resetForm"
            class="flex-1 text-sm py-2 rounded-2xl bg-slate-300 text-white font-bold transition-all duration-200
                   hover:text-black hover:scale-[1.05] active:scale-95"
        >
            やりなおす
        </button>
    </div>

</div>
