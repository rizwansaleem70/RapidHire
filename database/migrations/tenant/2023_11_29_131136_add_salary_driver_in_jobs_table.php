<?php

use Illuminate\Support\Facades\DB;
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
        DB::select("ALTER TABLE `jobs` CHANGE `salary_deliver` `salary_deliver` ENUM('monthly','yearly','hourly','weekly') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'monthly'; ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
