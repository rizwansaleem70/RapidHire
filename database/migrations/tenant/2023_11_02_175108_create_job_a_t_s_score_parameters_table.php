<?php

use App\Models\Tenants\JobATSScore;
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
        Schema::create('job_a_t_s_score_parameters', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(JobATSScore::class,'job_ATS_score_id');
            $table->string('parameter');
            $table->string('value');
            $table->timestamps();
            $table->foreign('job_ATS_score_id')->references('id')->on('job_a_t_s_scores')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_a_t_s_score_parameters');
    }
};
