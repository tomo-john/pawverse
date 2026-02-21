<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DogStatus extends Model
{
    protected $fillable = [
        'dog_id',
        'level',
        'exp',
        'happy',
        'stamina',
        'hunger',
    ];

    public function dog()
    {
        return $this->belongsTo(Dog::class);
    }
}
