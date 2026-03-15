<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="absolute top-4 left-4">
                    <i class="fa-solid fa-dog"></i>
                </div>
                <div class="absolute top-4 right-4">
                    <i class="fa-solid fa-dog"></i>
                </div>
                <div class="absolute bottom-4 left-4">
                    <i class="fa-solid fa-dog"></i>
                </div>
                <div class="absolute bottom-4 right-4">
                    <i class="fa-solid fa-dog"></i>
                </div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                    <i class="fa-solid fa-dog text-5xl"></i>
                </div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="absolute -top-2 -left-2">
                    <i class="fa-solid fa-dog text-9xl"></i>
                </div>
                <div class="relative p-4 font-bold text-sky-800">
                    じょんの部屋
                </div>
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="absolute top-4 left-4 flex gap-4">
                    <i class="fa-solid fa-dog text-5xl"></i>
                    <i class="fa-solid fa-dog text-5xl"></i>
                </div>
                <div class="absolute top-20 left-4 flex flex-col gap-4">
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>
