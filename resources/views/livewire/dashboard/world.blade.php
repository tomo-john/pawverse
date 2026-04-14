<div class="flex h-full w-full flex-col gap-6"
     x-data="dog()"
>


    <h2 class="text-gray-400">
        今日のラッキーわんこ🐶
    </h2>
    <div class="flex items-center gap-3">
        <p>名前: {{ $selectedDog->name }}</p>
        <div x-show="selectedDog">
            <button @click="alert(selectedDog.name + 'をなでなでした🐾')"
                    class="px-2 py-1 rounded-lg bg-pink-500 hover:bg-pink-600 cursor-pointer"
            >
                Alpineでなでなでする
            </button>
        </div>
    </div>

    {{-- Dog Field --}}
    <div class="w-full max-w-3xl mx-auto h-96 rounded-xl border p-6 overflow-hidden flex justify-center items-center" x-ref="field">
        <i class="fa-solid fa-dog {{ $selectedDog->sizeClass }}"
           style="color: {{ $selectedDog->color }};"
        ></i>
    </div>

    {{-- Debug --}}
    <p class="text-gray-400">
    サイズ: {{ $selectedDog->sizeClass }} /
    色: <span style="color: {{ $selectedDog->color }}">{{ $selectedDog->color }}</span> /
    性格: {{ $selectedDog->realDog?->personality }}({{ $selectedDog->realDog?->personality_label ?? '未登録' }}) /
    </p>

</div>

<script>
    function dog() {

        return {
            selectedDog: {{ Js::from($selectedDog) }},
        }
    }
</script>
