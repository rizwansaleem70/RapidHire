<?php

namespace Database\Seeders\tenant;

use App\Models\Tenants\Test;
use Illuminate\Database\Seeder;
use App\Models\Tenants\TestService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TestServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TestService::destroy([1, 2, 3]);

        TestService::create(['id' => 1, 'name' => 'SHL Direct']);
        Test::insert([
            [
                'test_service_id' => 1,
                'name' => 'Verbal Reasoning Test',
            ], [
                'test_service_id' => 1,
                'name' => ' Behavior-Based Assessment ',
            ], [
                'test_service_id' => 1,
                'name' => 'Process Monitoring Test ',
            ], [
                'test_service_id' => 1,
                'name' => 'Inductive Reasoning Test ',
            ], [
                'test_service_id' => 1,
                'name' => 'Contact Center Simulation',
            ]
        ]);
        $test2 = TestService::create(['id' => 2, 'name' => 'Gorilla Test']);
        Test::insert([
            [
                'test_service_id' => 2,
                'name' => 'Software Engineering',
            ], [
                'test_service_id' => 2,
                'name' => 'Machine Learning in Azure',
            ], [
                'test_service_id' => 2,
                'name' => 'Laravel ',
            ], [
                'test_service_id' => 2,
                'name' => 'Django REST Framework (DRF) ',
            ], [
                'test_service_id' => 2,
                'name' => 'HR Management',
            ]
        ]);
        $test3 = TestService::create(['id' => 3, 'name' => 'Emmersion Test']);
        Test::insert([
            [
                'test_service_id' => 3,
                'name' => 'Spanish (Proficient/C2) ',
            ], [
                'test_service_id' => 3,
                'name' => 'Customer service ',
            ], [
                'test_service_id' => 3,
                'name' => 'Program Management  ',
            ], [
                'test_service_id' => 3,
                'name' => 'Negotiation ',
            ], [
                'test_service_id' => 3,
                'name' => 'Critical thinking',
            ]
        ]);
    }
}
