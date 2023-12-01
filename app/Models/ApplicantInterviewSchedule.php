<?php

namespace App\Models;

use App\Models\TimeSlot;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicantInterviewSchedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'interviewer_id',
        'status',
        'time_slot_id',
        'cancel_reason',
        'cancel_time'
    ];

    public function timeSlot(): BelongsTo
    {
        return $this->belongsTo(TimeSlot::class, 'time_slot_id');
    }
}
