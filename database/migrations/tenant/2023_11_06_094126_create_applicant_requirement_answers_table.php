<?php

use App\Models\Tenants\Applicant;
use App\Models\Tenants\Requirement;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Tenants\Job;
use App\Models\User;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applicant_requirement_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Job::class,'job_id');
            $table->foreignIdFor(Applicant::class,'applicant_id');
            $table->foreignIdFor(Requirement::class,'requirement_id');
            $table->string('answer');
            $table->foreign('job_id')->references('id')->on('jobs')->onUpdate('cascade');
            $table->foreign('applicant_id')->references('id')->on('applicants')->onUpdate('cascade');
            $table->foreign('requirement_id')->references('id')->on('requirements')->onUpdate('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_requirement_answers');
    }
};
