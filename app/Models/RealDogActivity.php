<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class RealDogActivity extends Model
{
    protected $fillable = [
        'dog_id',
        'type',
        'value',
        'unit',
        'memo',
        'logged_at',
    ];

    protected $casts = [
        'logged_at' => 'datetime',
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
