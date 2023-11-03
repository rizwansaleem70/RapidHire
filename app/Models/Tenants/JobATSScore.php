<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobATSScore extends Model
{
    use HasFactory;
    public function JobATSScoreParameter(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(JobATSScoreParameter::class,'job_ATS_score_id');
    }
}
