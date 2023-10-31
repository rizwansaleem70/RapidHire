<?php

use App\Models\Tenants\Category;
use App\Models\Tenants\Department;
use App\Models\Tenants\Location;
use App\Models\User;
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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class,'user_id');
            $table->foreignIdFor(Location::class,'location_id');
            $table->foreignIdFor(Department::class,'department_id');
            $table->string('name');
            $table->text('job_description');
            $table->enum('type', ['contract', 'full-time', 'temporary', 'part-time'])->default('contract');
            $table->enum('job_type', ['onSite', 'remote', 'hybrid'])->default('onSite');
            $table->decimal('min_salary', 10, 2)->default(0);
            $table->decimal('max_salary', 10, 2)->default(0);
            $table->date('post_date');
            $table->integer('total_position');
            $table->date('expiry_date')->nullable();
            $table->decimal('rating', 3, 1)->default(0);
            $table->enum('status', ['published', 'draft'])->default('published');
            $table->enum('salary_deliver', ['monthly', 'yearly'])->default('monthly');
            $table->string('cover_image')->nullable();
            $table->integer('views')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('location_id')->references('id')->on('locations')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
