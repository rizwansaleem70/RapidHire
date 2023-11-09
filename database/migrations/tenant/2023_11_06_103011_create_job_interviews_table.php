<?php

use App\Models\User;
use App\Models\Tenants\Applicant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('candidate_interviews', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Applicant::class, 'applicant_id');
            $table->foreignIdFor(User::class, 'interviewer_id');
            $table->date('interview_date');
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->string('interviewer_link')->nullable();
            $table->string('interviewee_link')->nullable();
            $table->timestamps();
            $table->foreign('applicant_id')->references('id')->on('applicants')->onUpdate('cascade');
            $table->foreign('interviewer_id')->references('id')->on('users')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_interviews');
    }
};
