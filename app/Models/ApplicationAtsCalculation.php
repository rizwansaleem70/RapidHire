<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationAtsCalculation extends Model
{
    use HasFactory;

    public $table = 'application_ats_calculation';

    protected $fillable = [
        'criteria',
        'value',
        'weight'
    ];
}
