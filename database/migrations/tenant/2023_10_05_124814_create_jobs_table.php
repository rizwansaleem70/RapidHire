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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->enum('type', ['contract', 'full-time', 'temporary', 'part-time'])->default('contract');
            $table->enum('job_type', ['onSite', 'remote', 'hybrid'])->default('onSite');
            $table->decimal('min_salary', 10, 2)->default(0);
            $table->decimal('max_salary', 10, 2)->default(0);
            $table->date('post_date');
            $table->date('expiry_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->decimal('rating', 3, 1)->default(0);
            $table->enum('status', ['published', 'draft'])->default('published');
            $table->enum('salary_deliver', ['monthly', 'yearly'])->default('monthly');
            $table->string('image')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('location_id')->references('id')->on('locations')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
