<?php

use App\Models\Tenants\JobRequirement;
use Illuminate\Support\Facades\Schema;
use App\Models\Tenants\JobQualification;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('job_a_t_s_scores', function (Blueprint $table) {
            $table->dropForeign(['job_requirement_id']);
            $table->dropColumn('job_requirement_id');

            $table->foreignIdFor(JobQualification::class, 'job_qualification_id')->nullable()->after('id');
            $table->foreign('job_qualification_id')->references('id')->on('job_qualifications')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_a_t_s_scores', function (Blueprint $table) {
            $table->foreignIdFor(JobRequirement::class, 'job_requirement_id')->nullable()->after('id');
            $table->foreign('job_requirement_id')->references('id')->on('job_requirements')->onUpdate('cascade');

            $table->dropForeign(['job_qualification_id']);
            $table->dropColumn('job_qualification_id');
        });
    }
};
