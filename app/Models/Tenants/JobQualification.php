<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobQualification extends Model
{
    protected $fillable = ['job_id','name','input_type','option','position'];
    use HasFactory;
}
