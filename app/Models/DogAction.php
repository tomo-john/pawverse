<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
