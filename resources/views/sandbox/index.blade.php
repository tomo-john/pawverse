<x-layouts.guest>

    <div class="max-w-5xl mx-auto">
        <x-sandbox.dog />
        <x-sandbox.test1 />
        <x-sandbox.test2 />
        <x-sandbox.test3 />
        <x-sandbox.test4 />
    </div>

    <a href="{{ route('sandbox.page', 'alpine') }}">Alpine</a>

</x-layouts.guest>
