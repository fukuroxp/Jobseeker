<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoalItem extends Model
{
    protected $guarded = ['id'];

    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }
}
