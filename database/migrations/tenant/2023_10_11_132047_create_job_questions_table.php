<?php

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
        Schema::create('job_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Job::class,'job_id');
            $table->foreignIdFor(QuestionBank::class,'question_bank_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('job_id')->references('id')->on('jobs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('question_bank_id')->references('id')->on('question_banks')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_questions');
    }
};
