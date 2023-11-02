<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Tenants\City;
use App\Models\Tenants\Country;
use App\Models\Tenants\State;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('city');
            $table->string('avatar')->after('logo')->nullable();
            $table->foreignIdFor(Country::class,'country_id')->nullable()->default(1)->after('id');
            $table->foreignIdFor(State::class,'state_id')->nullable()->after('country_id');
            $table->foreignIdFor(City::class,'city_id')->nullable()->after('state_id');
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('avatar');
            $table->dropForeign(['country_id']);
            $table->dropForeign(['state_id']);
            $table->dropForeign(['city_id']);
            $table->dropColumn(['country_id', 'state_id', 'city_id']);
            $table->string('city');
        });
    }
};
