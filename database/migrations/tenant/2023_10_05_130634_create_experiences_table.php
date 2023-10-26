<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('post_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('organization_name');
            $table->string('address');
            $table->enum('experience_level', ['entry', 'junior', 'mid', 'senior', 'expert']);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('candidates')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
