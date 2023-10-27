<?php

namespace App\Models\Tenants;

use App\Models\JobQuestion;
use App\Models\Requirement;
use App\Models\User;
use App\Traits\General;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Job extends Model
{
    use HasFactory,SoftDeletes,General;
    public function getImageAttribute($value){
        return url(Storage::url($value));
    }
    public function jobQuestion(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(QuestionBank::class,'job_questions','job_id','question_bank_id');
    }
    public function jobHiringManager(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class,'job_hiring_managers','job_id','user_id');
    }
    public function jobTestService(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(TestService::class,'job_test_services','job_id','test_service_id');
    }
    public function requirement(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Requirement::class,'job_requirements','job_id','requirement_id');
    }
    public function location(){
        return $this->belongsTo(Location::class,'location_id','id');
    }
    public function favoriteJob()
    {
        return $this->belongsTo(FavoriteJob::class);
    }
}
