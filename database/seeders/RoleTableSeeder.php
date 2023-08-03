<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use App\Models\Module;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'SuperAdmin']);
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Employee']);
        Role::create(['name' => 'SubAdmin']);
        $admin1 = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => '12345678',
        ]);

        $admin1->assignRole('SuperAdmin');

        $module1 = Module::create([
            'name' => 'Employee',
        ]);

        $module2 =Module::create([
            'name' => 'Candidate',
        ]);

//      Employee Permissions
        Permission::create([
            'name' => 'employee.view',
            'module_id' => $module1->id
        ]);

        Permission::create([
            'name' => 'employee.edit',
            'module_id' => $module1->id
        ]);

        Permission::create([
            'name' => 'employee.delete',
            'module_id' => $module1->id
        ]);

//      Candidate Permissions
        Permission::create([
            'name' => 'candidate.view',
            'module_id' => $module2->id
        ]);
        Permission::create([
            'name' => 'candidate.edit',
            'module_id' => $module2->id
        ]);
        Permission::create([
            'name' => 'candidate.delete',
            'module_id' => $module2->id
        ]);

    }
}
