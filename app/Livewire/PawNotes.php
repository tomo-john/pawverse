<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PawNote;

class PawNotes extends Component
{
    public string $body = '';

    public function save()
    {
        sleep(2);

        $this->validate([
            'body' => 'required|string|max:255'
        ]);

        PawNote::create([
            'body' => $this->body,
        ]);

        $this->reset('body');
    }

    public function render()
    {
        return view('livewire.paw-notes');
    }
}
