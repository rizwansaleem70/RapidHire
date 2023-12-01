<?php

use App\Models\User;
use App\Helpers\Constant;
use App\Models\TimeSlot;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applicant_interview_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')->index();
            $table->foreignIdFor(User::class, 'interviewer_id')->index();
            $table->foreignIdFor(TimeSlot::class, 'time_slot_id')->index();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('interviewer_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('time_slot_id')->references('id')->on('time_slots')->cascadeOnDelete();

            $table->enum('status', [Constant::SLOT_AVAILABLE, Constant::SLOT_BOOKED, Constant::SLOT_CANCELLED, Constant::SLOT_PENDING])->default(Constant::SLOT_AVAILABLE);

            $table->string('cancel_reason')->nullable();
            $table->timestamp('cancel_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applicant_interview_schedules', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['interviewer_id']);
            $table->dropForeign(['time_slot_id']);
        });
        Schema::dropIfExists('applicant_interview_schedules');
    }
};
