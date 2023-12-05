<?php

use App\Models\TimeSlot;
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
        Schema::dropIfExists('applicant_interview_schedules');
        Schema::table('candidate_interviews', function (Blueprint $table) {
            $table->foreignIdFor(TimeSlot::class, 'time_slot_id')->nullable();
            $table->foreign('time_slot_id')->references('id')->on('time_slots');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('applicant_interview_schedules', function (Blueprint $table) {
            $table->id();
        });

        Schema::table('candidate_interviews', function (Blueprint $table) {
            $table->dropForeign(['time_slot)id']);
            $table->dropColumn('time_slot_id');
        });
    }
};
