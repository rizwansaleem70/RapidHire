<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobQualification extends Model
{
    protected $fillable = ['job_id','requirement_id','name','input_type','option','operator','value','is_required'];
    use HasFactory;
}
