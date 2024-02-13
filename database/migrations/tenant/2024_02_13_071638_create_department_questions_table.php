<?php

use App\Models\Tenants\Department;
use App\Models\Tenants\QuestionBank;
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
        Schema::create('department_questions', function (Blueprint $table) {
            $table->foreignIdFor(Department::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(QuestionBank::class)->constrained()->onDelete('cascade');
            $table->primary(['department_id', 'question_bank_id']);
            $table->index('department_id');
            $table->index('question_bank_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department_questions');
    }
};
