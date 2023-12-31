<?php

use App\Models\Tenants\Job;
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
        if (Schema::hasTable('job_ats_points')) {
            Schema::table('job_ats_points', function (Blueprint $table) {
                $table->dropForeign(['job_ats_id']);
                $table->dropColumn('job_ats_id');
            });

            Schema::dropIfExists('job_ats_points');
        }
        if (Schema::hasTable('job_ats')) {
            Schema::table('job_ats', function (Blueprint $table) {
                $table->dropForeign(['job_id']);
                $table->dropColumn('job_id');
            });
            Schema::dropIfExists('job_ats');
        }
        Schema::create('job_a_t_s_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Job::class,'job_id');
            $table->string('attribute');
            $table->float('weight');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('job_id')->references('id')->on('jobs')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_a_t_s_scores');
    }
};
