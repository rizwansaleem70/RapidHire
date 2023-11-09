<?php

use App\Models\Tenants\Applicant;
use App\Models\Tenants\Job;
use App\Models\Tenants\QuestionBank;
use App\Models\User;
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
        Schema::create('applicant_question_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Job::class,'job_id');
            $table->foreignIdFor(Applicant::class,'applicant_id');
            $table->foreignIdFor(QuestionBank::class,'question_bank_id');
            $table->string('answer');
            $table->foreign('job_id')->references('id')->on('jobs')->onUpdate('cascade');
            $table->foreign('applicant_id')->references('id')->on('applicants')->onUpdate('cascade');
            $table->foreign('question_bank_id')->references('id')->on('question_banks')->onUpdate('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_question_answers');
    }
};
