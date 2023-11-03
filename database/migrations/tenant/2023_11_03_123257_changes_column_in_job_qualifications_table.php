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
        Schema::table('job_qualifications', function (Blueprint $table) {
            if (Schema::hasColumn("job_qualifications", "job_q_field_id")){
                $table->dropForeign(['job_q_field_id']);
                $table->dropColumn('job_q_field_id');
            }
            if (Schema::hasColumn("job_qualifications", "job_q_field_value_id")){
                $table->dropForeign(['job_q_field_value_id']);
                $table->dropColumn('job_q_field_value_id');
            }
            if (Schema::hasColumn("job_qualifications", "operator")){
                $table->dropColumn('operator');
            }
            $table->string('name')->after('job_id');
            $table->string('input_type')->after('name');
            $table->string('option')->after('input_type');
            $table->tinyInteger('position')->change();
        });
        if (Schema::hasTable('job_qualification_field_values'))
        {
            Schema::table('job_qualification_field_values', function (Blueprint $table) {
                $table->dropForeign(['job_q_field_id']);
            });
            Schema::dropIfExists('job_qualification_field_values');
        }
        if (Schema::hasTable('job_qualification_fields'))
        {
            Schema::dropIfExists('job_qualification_fields');
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_qualifications', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('input_type');
            $table->dropColumn('option');
            $table->integer('position')->change();
        });
    }
};
