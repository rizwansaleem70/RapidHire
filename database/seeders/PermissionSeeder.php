<?php

namespace Database\Seeders\tenant;

use Illuminate\Database\Seeder;
use App\Models\Tenants\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $modules = ["jobs", "applicants", 'message', 'schedules', 'members', 'settings', 'faqs', 'invoices', 'roles'];
        $actions = ["*", "view", "update", "create", "delete"];

        foreach ($modules as $module) {
            foreach ($actions as $value) {
                Permission::create(['name' => $module . '.' . $value]);
            }
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
