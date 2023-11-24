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
        Schema::table('job_experiences', function (Blueprint $table) {
            $table->date('end_date')->nullable()->change();
            $table->boolean('is_present')->nullable()->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_experiences', function (Blueprint $table) {
            $table->date('end_date')->nullable(false)->change();
            $table->string('is_present')->default('0')->change();
        });
    }
};
