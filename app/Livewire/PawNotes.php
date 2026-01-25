<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PawNote;

class PawNotes extends Component
{
    public string $body = '';
    public bool $saved = false;

    public function save()
    {
        $this->validate([
            'body' => 'required|string|max:255'
        ]);

        PawNote::create([
            'body' => $this->body,
        ]);

        $this->reset('body');
        $this->saved = true;
    }

    public function render()
    {
        return view('livewire.paw-notes');
    }
}
