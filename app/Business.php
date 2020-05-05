<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'prefixes' => 'array'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
