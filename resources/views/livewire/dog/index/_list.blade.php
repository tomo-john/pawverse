<flux:heading size="md">
    <i class="fa-solid fa-dog mx-1"></i>
    Your Dogs
    <i class="fa-solid fa-dog mx-1"></i>
</flux:heading>

<div class="max-w-5xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    @forelse($this->dogs as $dog)
        @include('livewire.dog.index._card')
    @empty
        <p class="text-gray-500">まだ登録されたわんちゃんはいません 🐾</p>
    @endforelse
</div>
