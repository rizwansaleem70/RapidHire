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
            $table->dropColumn('post_name');
            $table->dropColumn('address');
            $table->dropColumn('experience_level');
            $table->string('position_title')->after('user_id');
            $table->string('source_detail')->after('position_title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('experiences', function (Blueprint $table) {
            $table->dropColumn('position_title');
            $table->dropColumn('source_detail');
        });
    }
};
