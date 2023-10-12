<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionBank extends Model
{
    use HasFactory;
    public function job(){
        return $this->belongsToMany(Job::class,'job_questions','question_bank_id','job_id');
    }
}
