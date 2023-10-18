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
        Schema::create('job_qualification_field_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_q_field_id');
            $table->string('value');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('job_q_field_id')->references('id')->on('job_qualification_fields')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_qualification_field_values');
    }
};
