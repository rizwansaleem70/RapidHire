<?php

use App\Models\Tenants\Department;
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
        Schema::table('question_banks', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropColumn('department_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('question_banks', function (Blueprint $table) {
            $table->foreignIdFor(Department::class,'department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('cascade');
        });
    }
};
