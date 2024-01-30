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
        Schema::table('candidate_interviews', function (Blueprint $table) {
            $table->tinyInteger('speaking')->default(0)->nullable();
            $table->tinyInteger('listening')->default(0)->nullable();
            $table->tinyInteger('language')->default(0)->nullable();
            $table->tinyInteger('behavior')->default(0)->nullable();
            $table->text('interviewer_feedback')->nullable();
            $table->dateTime('feedback_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidate_interviews', function (Blueprint $table) {
            $table->dropColumn([
                'speaking',
                'listening',
                'language',
                'behavior',
                'interviewer_feedback',
                'feedback_date'
            ]);
        });
    }
};
