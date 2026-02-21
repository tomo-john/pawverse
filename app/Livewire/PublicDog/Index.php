<?php

namespace App\Livewire\PublicDog;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Dog;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public string $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        sleep(1); // ローディング表示確認用
        $dogs = Dog::query()
            ->with('user') // N+1問題回避🐶
            ->where('is_public', true)
            ->when($this->search, function ($q) {
                $q->where(function ($subQuery) {
                    $subQuery->where('name', 'like', "%{$this->search}%")
                             ->orWhereHas('user', fn($u) =>
                                $u->where('name', 'like', "%{$this->search}%")
                             );
                });
            })
            ->latest()
            ->paginate(9);

        return view('livewire.public-dog.index', compact('dogs'))
            ->layout('layouts::guest');
    }
}
