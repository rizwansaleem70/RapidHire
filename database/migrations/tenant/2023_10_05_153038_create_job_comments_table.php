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
        Schema::create('job_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id');
            $table->decimal('rating', 3, 1);
            $table->text('comment');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('job_id')->references('id')->on('jobs')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_comments');
    }
};
