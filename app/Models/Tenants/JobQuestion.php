<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobQuestion extends Model
{
    use HasFactory;
    public function questionBank(){
        return $this->belongsTo(QuestionBank::class,'question_bank_id','id');
    }
}
