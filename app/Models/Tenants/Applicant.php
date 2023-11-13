<?php

namespace App\Models\Tenants;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function job(){
        return $this->belongsTo(Job::class,'job_id');
    }
}
