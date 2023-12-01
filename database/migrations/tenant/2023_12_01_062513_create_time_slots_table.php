<?php

use App\Models\User;
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
        Schema::create('time_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')->index()->comment('Interviewers');
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('status', ['AVAILABLE', 'BOOKED', 'CANCELED', 'PENDING'])->default('AVAILABLE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_slots');
    }
};
