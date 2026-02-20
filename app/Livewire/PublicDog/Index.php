<?php

namespace App\Livewire\PublicDog;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Dog;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $dogs = Dog::query()
            ->with('user') // N+1問題回避🐶
            ->where('is_public', true)
            ->latest()
            ->paginate(9);

        return view('livewire.public-dog.index', [
            'dogs' => $dogs,
        ])->layout('layouts::guest');
    }
}
