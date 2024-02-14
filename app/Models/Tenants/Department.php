<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method find($id)
 * @method where(string $string, $name)
 * @method latest()
 */
class Department extends Model
{
    use HasFactory,SoftDeletes;
    public function job(){
        return $this->hasMany(Job::class,'department_id');
    }
    public function questionBank()
    {
        return $this->belongsToMany(QuestionBank::class, 'department_questions');
    }
    // public function questionBank(){
    //     return $this->hasMany(QuestionBank::class,'department_id');
    // }
}
