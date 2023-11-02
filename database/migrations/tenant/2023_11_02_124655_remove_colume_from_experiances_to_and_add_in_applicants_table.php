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
        Schema::table('experiences', function (Blueprint $table) {
            $table->dropColumn('source_detail');
        });

        Schema::table('applicants', function (Blueprint $table) {
            $table->string('source_detail')->after('applied_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->dropColumn('source_detail');
        });
        Schema::table('experiences', function (Blueprint $table) {
            $table->string('source_detail')->after('organization_name')->nullable();
        });
    }
};
