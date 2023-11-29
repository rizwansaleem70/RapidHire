<?php

use App\Models\Tenants\Applicant;
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
        Schema::table('job_experiences', function (Blueprint $table) {
//            $table->dropForeign(['user_id']);
//            $table->renameColumn('user_id','applicant_id');
            $table->foreign('applicant_id')->references('id')->on('applicants')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_experiences', function (Blueprint $table) {
            $table->dropForeign(['applicant_id']);
            $table->renameColumn('applicant_id','user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }
};
