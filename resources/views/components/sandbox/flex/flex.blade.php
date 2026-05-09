<div x-data="flex()"
     class="max-w-full mx-auto flex flex-col gap-2 mt-2"
>

    <h1 class="flex items-center gap-2 text-pink-500">
        Flex
        <i class="fa-solid fa-dog"></i>
    </h1>
    <div class="flex gap-10">
        <div class="relative flex justify-center items-center w-64 h-64 border-2 border-pink-500">
            {{-- 中央の犬 --}}
            <div class="border border-pink-200 p-1">
                <i class="fa-solid fa-dog text-2xl text-pink-200"></i>
            </div>

            {{-- absolute --}}
            <div class="border border-pink-300 p-1 absolute top-4 left-4">
                <i class="fa-solid fa-dog text-2xl text-pink-300"></i>
            </div>
            <div class="border border-pink-400 p-1 absolute bottom-4 right-4">
                <i class="fa-solid fa-dog text-2xl text-pink-400"></i>
            </div>
        </div>

        <div class="relative flex flex-wrap gap-2 w-64 h-64 border-2 border-pink-500 p-2">
            @foreach(range(1, 50) as $i)
                <i class="fa-solid fa-dog text-pink-500"></i>
            @endforeach
        </div>
    </div>
</div>

<script>
    function flex() {
        return {
            init() {
                console.log("flex🐶");
            }
        }
    }
</script>
