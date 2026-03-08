<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class DogAction extends Model
{
    protected $fillable = [
        'dog_id',
        'action',
    ];

    public function dog()
    {
        return $this->belongsTo(Dog::class);
    }

    public function statusLogs(): MorphMany
    {
        return $this->morphMany(DogStatusLog::class, 'source');
    }
}
