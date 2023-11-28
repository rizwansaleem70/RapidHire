<?php

use App\Models\Tenants\JobRequirement;
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
        Schema::table('job_a_t_s_scores', function (Blueprint $table) {
            $table->foreignIdFor(JobRequirement::class,'job_requirement_id')->nullable()->after('id');
            $table->foreign('job_requirement_id')->references('id')->on('job_requirements')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_a_t_s_scores', function (Blueprint $table) {
            $table->dropForeign(['job_requirement_id']);
            $table->dropColumn(['job_requirement_id']);
        });
    }
};
