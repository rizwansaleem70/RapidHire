<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestService extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    /**
     * Get all of the tests for the TestService
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tests(): HasMany
    {
        return $this->hasMany(Test::class, 'test_service_id');
    }
}
