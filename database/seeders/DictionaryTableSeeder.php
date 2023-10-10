<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DictionaryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $userStatus = ['DUE' => 'warning', 'PAID' => 'success', 'UNPAID' => 'danger', 'OVERDUE' => 'info'];
        $index = 0;
        foreach ($userStatus as $key => $value) {
            Dictionary::create([
                'entity' => 'INVOICE',
                'key' => 'STATUS',
                'value' => $key,
                'sort' => $index++,
                'meta' => ['color' => $value]
            ]);
        }
        $userStatus = ['TEMP_ACTIVE' => 'warning', 'ACTIVE' => 'success', 'INACTIVE' => 'danger'];
        $index = 0;
        foreach ($userStatus as $key => $value) {
            Dictionary::create([
                'entity' => 'TENANT',
                'key' => 'STATUS',
                'value' => $key,
                'sort' => $index++,
                'meta' => ['color' => $value]
            ]);
        }
        $gender = ['male', 'female', 'other'];
        foreach ($gender as $key => $value) {
            Dictionary::create([
                'entity' => 'GENERAL',
                'key' => 'GENDER',
                'value' => $value,
                'sort' => $key
            ]);
        }

        $paymentType = ['sandbox','production'];
        foreach ($paymentType as $key => $value) {
            Dictionary::create([
                'entity' => 'ENVIRONMENT',
                'key' => 'TYPE',
                'value' => $value,
                'sort' => $key,
            ]);
        }


        $extra_land = ['paid', 'not paid'];
        foreach ($extra_land as $key => $value) {
            Dictionary::create([
                'entity' => 'EXTRA_LAND',
                'key' => 'TYPE',
                'value' => $value,
                'sort' => $key,
            ]);
        }
    }
}
