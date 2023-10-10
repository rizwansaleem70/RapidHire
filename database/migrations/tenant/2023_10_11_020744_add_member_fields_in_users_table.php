<?php

use App\Models\Tenants\Department;
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
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->foreignIdFor(Department::class, 'department_id')->nullable();
            $table->boolean('status')->default(1)->nullable();
            $table->string('designation')->nullable();

            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['department_id']);

            $table->dropColumn([
                'first_name',
                'last_name',
                'phone',
                'department_id',
                'status',
                'designation',
            ]);
        });
    }
};
