<?php

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
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('current_salary')->after('avatar')->nullable();
            $table->enum('salary_type',['hourly','monthly','yearly'])->after('current_salary')->nullable();
            $table->string('language')->after('salary_type')->nullable();
            $table->text('skills')->after('language')->nullable();
            $table->text('introduction_video_url')->after('skills')->nullable();
            $table->string('resume_path')->after('introduction_video_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('current_salary');
            $table->dropColumn('salary_type');
            $table->dropColumn('language');
            $table->dropColumn('skills');
            $table->dropColumn('introduction_video_url');
            $table->dropColumn('resume_path');
        });
    }
};
