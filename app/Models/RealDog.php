<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RealDog extends Model
{
    protected $fillable = [
        'dog_id',
        'breed',
        'sex',
        'personality',
        'birthday',
        'photo_path'
    ];

    public function dog()
    {
        return $this->belongsTo(Dog::class);
    }
}
