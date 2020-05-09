<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'products' => 'array'
    ];

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
