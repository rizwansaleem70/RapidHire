<?php

use App\Models\Tenants\JobRequirement;
use App\Models\Tenants\Requirement;
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
        Schema::table('job_qualifications', function (Blueprint $table) {
            $table->dropColumn('position');
            $table->foreignIdFor(Requirement::class,'requirement_id')->after('id')->nullable();
            $table->string('operator')->after('option');
            $table->string('value')->after('operator');
            $table->boolean('is_required')->after('value');
            $table->foreign('requirement_id')->references('id')->on('requirements')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_qualifications', function (Blueprint $table) {
            $table->string('position');
            $table->dropForeign(['requirement_id']);
            $table->dropColumn('requirement_id');
            $table->dropColumn('operator');
            $table->dropColumn('value');
            $table->dropColumn('is_required');
        });
    }
};
