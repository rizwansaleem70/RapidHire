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
        Schema::create('job_qualifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('job_q_field_id');
            $table->unsignedBigInteger('job_q_field_value_id');
            $table->string('operator');
            $table->integer('position');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('job_id')->references('id')->on('jobs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('job_q_field_id')->references('id')->on('job_qualification_fields')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('job_q_field_value_id')->references('id')->on('job_qualification_field_values')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_qualifications');
    }
};
