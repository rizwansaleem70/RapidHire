<?php

use App\Models\Tenants\City;
use App\Models\Tenants\Country;
use App\Models\Tenants\State;
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
        Schema::table('applicants', function (Blueprint $table) {
            $table->foreignIdFor(Country::class,'country_id')->nullable()->after('user_id');
            $table->foreignIdFor(State::class,'state_id')->nullable()->after('country_id');
            $table->foreignIdFor(City::class,'city_id')->nullable()->after('state_id');
            $table->string('first_name')->after('city_id');
            $table->string('last_name')->after('first_name');
            $table->string('phone')->after('last_name');
            $table->string('address')->after('phone');
            $table->string('gender')->after('address');
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onUpdate('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
            $table->dropForeign(['state_id']);
            $table->dropForeign(['city_id']);
            $table->dropColumn(['country_id', 'state_id', 'city_id','first_name','last_name','phone','address','gender']);
        });
    }
};
