<?php

namespace App\Models\Tenants;

use App\Models\Tenants\Job;
use App\Models\Tenants\Test;
use App\Models\Tenants\TestService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobTestService extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_id',
        'test_service_id',
        'test_id'
    ];

    /**
     * Get the job that owns the JobTestService
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(TestService::class, 'test_service_id');
    }

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class, 'test_id');
    }
}
