<?php

namespace App\Models\Tenants;

use App\Models\User;
use App\Models\Tenants\Applicant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CandidateInterviews extends Model
{
    use HasFactory;

    /**
     * Get the interviewer that owns the CandidateInterviews
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function interviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'interviewer_id');
    }

    /**
     * Get the applicant that owns the CandidateInterviews
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function applicant(): BelongsTo
    {
        return $this->belongsTo(Applicant::class, 'applicant_id');
    }
}
