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
        Schema::create('job_test_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_test_id');
            $table->unsignedBigInteger('test_point_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('job_test_id')->references('id')->on('job_tests')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('test_point_id')->references('id')->on('test_points')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_test_values');
    }
};
