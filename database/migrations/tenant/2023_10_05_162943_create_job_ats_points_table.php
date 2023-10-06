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
        Schema::create('job_ats_points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_ats_id');
            $table->string('value');
            $table->integer('points');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('job_ats_id')->references('id')->on('job_ats')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_ats_points');
    }
};
