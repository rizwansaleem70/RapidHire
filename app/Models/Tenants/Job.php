<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Job extends Model
{
    use HasFactory,SoftDeletes;
    public function getImageAttribute($value){
        return url(Storage::url($value));
    }
}
