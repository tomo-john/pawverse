<x-layouts.guest>

<div x-data="sandbox()">
    @php
        $pages = [
            'maze'   => 'Maze',
            'walk'   => 'Walk',
        ];
    @endphp

    <div class="max-w-5xl mx-auto">

        {{-- Header --}}
        <div class="p-6 m-6">
            <div class="flex justify-center items-center gap-2">
                <i class="fa-solid fa-dog text-5xl text-pink-500"></i>
                <span class="text-sm text-pink-600">SandBoxへようこそ</span>
            </div>
        </div>

        {{-- Menu --}}
        <div class="text-center text-3xl">Menu</div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 m-6">
            @foreach($pages as $slug => $label)
                <a href="{{ route('sandbox.page', $slug) }}"
                   class="flex justify-center items-center h-24 px-4 py-3 bg-pink-400 hover:bg-pink-500 text-white font-semibold rounded-lg shadow-md transition duration-300">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        {{-- Alpine --}}
        <div class="animate-bounce">
            <a href="{{ route('sandbox.page', 'alpine') }}">
                <i class="fa-solid fa-dog"></i>
            </a>
        </div>
    </div>

</div>

<script>
    function sandbox() {
        console.log('sandbox🐶');

        return {
        }
    }
</script>

</x-layouts.guest>
