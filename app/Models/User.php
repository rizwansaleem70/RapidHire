<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Tenants\Applicant;
use App\Models\Tenants\Candidate\FavoriteJob;
use App\Models\Tenants\City;
use App\Models\Tenants\Country;
use App\Models\Tenants\Education;
use App\Models\Tenants\Experience;
use App\Models\Tenants\Job;
use App\Models\Tenants\JobExperience;
use App\Models\Tenants\State;
use App\Traits\SoftDeleteColumnValuesUpdate;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'dob' => 'date'
    ];
    public function getAvatarAttribute($value): string
    {
        return asset($value);
    }
    public static function checkPassword($current_password, $hash_password)
    {
        return Hash::check($current_password, $hash_password);
    }
    public function jobHiringManager(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Job::class,'job_hiring_managers','user_id','job_id');
    }
    public function favoriteJobs()
    {
        return $this->hasMany(FavoriteJob::class);
    }
    public function applicant(){
        return $this->hasOne(Applicant::class,'user_id');
    }
    public function experience(){
        return $this->hasMany(Experience::class,'user_id');
    }
    public function jobExperience(){
        return $this->hasMany(JobExperience::class,'user_id');
    }
    public function education(){
        return $this->hasMany(Education::class,'user_id');
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

}
