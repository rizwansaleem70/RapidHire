<?php

use App\Models\Tenants\Test;
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
        Schema::table('job_test_services', function (Blueprint $table) {
            $table->foreignIdFor(Test::class, 'test_id')->after('test_service_id');
            $table->foreign('test_id')->references('id')->on('tests');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_test_services', function (Blueprint $table) {
            $table->dropForeign(['test_id']);
            $table->dropColumn('test_id');
        });
    }
};
