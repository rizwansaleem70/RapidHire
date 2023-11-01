<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\tenant\CountriesTableSeeder;
use Database\Seeders\tenant\StatesTableSeeder;
use Database\Seeders\tenant\CitiesTableChunkOneSeeder;
use Database\Seeders\tenant\CitiesTableChunkTwoSeeder;
use Database\Seeders\tenant\CitiesTableChunkThreeSeeder;
use Database\Seeders\tenant\CitiesTableChunkFourSeeder;
use Database\Seeders\tenant\CitiesTableChunkFiveSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $this->call(CountriesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(CitiesTableChunkOneSeeder::class);
        $this->call(CitiesTableChunkTwoSeeder::class);
        $this->call(CitiesTableChunkThreeSeeder::class);
        $this->call(CitiesTableChunkFourSeeder::class);
        $this->call(CitiesTableChunkFiveSeeder::class);

        // $this->call(RoleTableSeeder::class);
        // $this->call(DictionaryTableSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
