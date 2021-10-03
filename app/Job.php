<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $guarded = ['id'];
    
    public function business() {
        return $this->belongsTo(Business::class);
    }

    public function job_applicant() {
        return $this->hasMany(JobApplicant::class);
    }
}
