<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $guarded = ['id'];

    public function jobs() {
        return $this->hasMany(Job::class);
    }
    
    public function job_applicant() {
        return $this->hasMany(JobApplicant::class);
    }

    public function user() {
        return $this->belongsTo(Job::class);
    }
}
