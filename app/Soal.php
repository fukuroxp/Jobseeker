<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $guarded = ['id'];

    public function soal_item()
    {
        return $this->hasMany(SoalItem::class);
    }
}
