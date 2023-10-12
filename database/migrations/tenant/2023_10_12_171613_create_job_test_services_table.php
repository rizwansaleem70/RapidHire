<?php

use App\Models\Tenants\Job;
use App\Models\Tenants\TestService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_test_services', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Job::class,'job_id');
            $table->foreignIdFor(TestService::class,'test_service_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('job_id')->references('id')->on('jobs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('test_service_id')->references('id')->on('test_services')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_test_services');
    }
};
