<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-col gap-6">

        {{-- status cards --}}
        <div class="grid gap-4 md:grid-cols-3">

            <div class="rounded-xl border p-4">
                <div class="text-sm text-gray-500">Hunger</div>
                <div class="text-3xl font-bold">65</div>
            </div>

            <div class="rounded-xl border p-4">
                <div class="text-sm text-gray-500">Mood</div>
                <div class="text-3xl font-bold">Happy 🐶</div>
            </div>

            <div class="rounded-xl border p-4">
                <div class="text-sm text-gray-500">Energy</div>
                <div class="text-3xl font-bold">82</div>
            </div>

        </div>

        {{-- dog room --}}
        <div class="flex-1 rounded-xl border p-6">
            <div class="text-lg font-bold mb-4">
                じょんの部屋
            </div>

            <div class="flex items-center justify-center h-64">
                <i class="fa-solid fa-dog text-7xl"></i>
            </div>
        </div>

        {{-- logs --}}
        <div class="grid gap-4 md:grid-cols-2">

            <div class="rounded-xl border p-4">
                <div class="font-bold mb-2">
                    Recent Messages
                </div>
            </div>

            <div class="rounded-xl border p-4">
                <div class="font-bold mb-2">
                    Activity Log
                </div>
            </div>

        </div>

    </div>
</x-layouts::app>
