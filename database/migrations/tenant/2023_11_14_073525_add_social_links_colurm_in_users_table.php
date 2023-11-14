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
        Schema::table('users', function (Blueprint $table) {
            $table->text('facebook')->after('remember_token')->nullable();
            $table->text('linkedin')->after('facebook')->nullable();
            $table->text('twitter')->after('linkedin')->nullable();
            $table->text('instagram')->after('twitter')->nullable();
            $table->text('pinterest')->after('instagram')->nullable();
            $table->text('youtube')->after('pinterest')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('facebook');
            $table->dropColumn('linkedin');
            $table->dropColumn('twitter');
            $table->dropColumn('instagram');
            $table->dropColumn('pinterest');
            $table->dropColumn('youtube');
        });
    }
};
