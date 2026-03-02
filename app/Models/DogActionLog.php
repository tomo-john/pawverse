<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Domain\Dog\DogActionDefinition;

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
        return DogActionDefinition::get($this->action);
    }

    public function dog()
    {
        return $this->belongsTo(Dog::class);
    }
}
