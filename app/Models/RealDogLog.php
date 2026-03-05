<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RealDogLog extends Model
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
}
