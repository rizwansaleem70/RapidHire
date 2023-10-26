<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     *
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id()->bigIncrements();
            $table->unsignedBigInteger('package_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password');
            $table->string('bank_name');
            $table->string('account_number')->unique();
            $table->double('latitude');
            $table->double('longitude');
            $table->text('address');
            $table->text('logo')->nullable();
            $table->text('about')->nullable();
            $table->string('website');
            $table->string('industry');
            $table->string('company_size');
            $table->string('headquarter');
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_actively_recruiting')->default(false);
            $table->json('data')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('package_id')->references('id')->on('packages')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
}
