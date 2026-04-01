<x-layouts.base>
    <div class="flex min-h-screen">

        <main class="flex-1 p-8">
            <div class="rounded-3xl p-6 shadow-sm min-h-[80vh]">
                {{ $slot }}
            </div>
        </main>

    </div>
</x-layouts.base>
