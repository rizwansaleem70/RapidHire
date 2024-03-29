<?php

use App\Models\Tenants\Applicant;
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
        Schema::create('application_ats_calculation', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Applicant::class, 'application_id');
            $table->string('attribute');
            $table->string('criteria');
            $table->string('weight');
            $table->string('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_ats_calculation');
    }
};
