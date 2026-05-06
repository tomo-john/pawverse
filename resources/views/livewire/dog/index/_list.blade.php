<div class="flex items-center gap-3 text-slate-500">
    <i class="fa-solid fa-dog text-pink-300"></i>
    <h2 class="text-lg font-bold">
        一緒に暮らしているわんこたち
    </h2>
</div>

<div class="max-w-5xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    @forelse($this->dogs as $dog)
        @include('livewire.dog.index._dog_house')
    @empty
        <div class="flex items-center gap-3 text-slate-500">
            <i class="fa-solid fa-paw"></i>
            <h2 class="text-lg font-bold">
                まだ誰もいないわん...
            </h2>
        </div>
    @endforelse
</div>
