<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Dog;

new class extends Component
{

    #[Computed]
    public function dogs()
    {
        return auth()->user()->dogs()->latest()->with('status')->get();
    }

};
?>

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex flex-col gap-4">
        <h1 class="text-2xl font-bold text-slate-500 flex gap-2">
            <i class="fa-solid fa-dog"></i>
            Dog Dashboard
        </h1>

        <p class="text-gray-500 text-sm font-bold">Count: {{ $this->dogs->count() }}</p>
    </div>

    {{-- Dogs Info --}}
    <div class="flex flex-col gap-4 w-full">
        @foreach($this->dogs as $dog)
            <div class="flex items-center gap-4 border rounded-2xl py-4 px-6">
                <i class="fa-solid fa-dog text-4xl" style="color: {{ $dog->color }}"></i>
                <div class="flex flex-col gap-1 text-white font-bold text-sm ">
                    <span>{{ $dog->name }}</span>
                    <span> Lv. {{ $dog->status->level }} (Size. {{ $dog->size_level }})</span>
                </div>
            </div>
        @endforeach
    </div>
</div>
