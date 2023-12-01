<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\ApplicantInterviewSchedule;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimeSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'start_time',
        'end_time'
    ];

    /**
     * Get the interviewer that owns the Timeslot
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function interviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'interviewer_id');
    }

    public function applicantSlots(): BelongsTo
    {
        return $this->belongsTo(ApplicantInterviewSchedule::class, 'user_id');
    }
}
