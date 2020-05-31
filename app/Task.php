<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    
    protected $guarded = ['id'];

    public function task_user()
    {
        return $this->hasOne(TaskUser::class);
    }
}
