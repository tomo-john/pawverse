<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class DogStatusLog extends Model
{
    protected $fillable = [
        'dog_id',
        'source_type',
        'source_id',
        'status_type',
        'delta',
    ];

    public function source(): MorphTo
    {
        return $this->morphTo();
    }

    public function dog()
    {
        return $this->belongsTo(Dog::class);
    }
}
