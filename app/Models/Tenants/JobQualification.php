<?php

namespace App\Models\Tenants;

use App\Models\Tenants\Requirement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobQualification extends Model
{
    protected $fillable = ['job_id', 'requirement_id', 'name', 'input_type', 'option', 'operator', 'value', 'is_required'];
    use HasFactory;

    /**
     * Get the requirement that owns the JobQualification
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function requirement(): BelongsTo
    {
        return $this->belongsTo(Requirement::class, 'requirement_id');
    }
}
