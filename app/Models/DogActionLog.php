<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Actions\Dog\DogAction;

class DogActionLog extends Model
{
    protected $fillable = [
        'dog_id',
        'action',
        'payload',
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    public function getDefinitionAttribute(): array
    {
        return DogAction::get($this->action);
    }

    public function dog()
    {
        return $this->belongsTo(Dog::class);
    }
}
