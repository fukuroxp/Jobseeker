<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    protected $guarded = ['id'];

    public function replies()
    {
        return $this->hasMany(FeedReply::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
