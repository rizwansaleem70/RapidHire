<?php

use App\Models\Tenants\Job;
use App\Models\User;
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
        Schema::create('job_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class,'user_id');
            $table->foreignIdFor(Job::class,'job_id');
            $table->string('position_title');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('organization_name');
            $table->string('is_present')->default('0');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('job_id')->references('id')->on('jobs')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_experiences');
    }
};
