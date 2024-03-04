<?php

namespace App\Models\Tenants;

use App\Models\ApplicationAtsCalculation;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Applicant extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
    public function country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
    public function state(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }
    public function city(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    public function jobExperience(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(JobExperience::class, 'applicant_id', 'id');
    }
    public function applicantQuestionAnswer(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ApplicantQuestionAnswer::class, 'applicant_id');
    }
    public function applicantRequirementAnswer(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ApplicantRequirementAnswer::class, 'applicant_id');
    }

    /**
     * Get all of the ats for the Job
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function atsCalculation(): HasMany
    {
        return $this->hasMany(ApplicationAtsCalculation::class, 'application_id');
    }
}
