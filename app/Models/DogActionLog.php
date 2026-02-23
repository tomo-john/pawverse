<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function dog()
    {
        return $this->belongsTo(Dog::class);
    }
}
