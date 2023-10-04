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
        Role::create(['name' => 'Tenant']);
        Role::create(['name' => 'SubAdmin']);
        $admin1 = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@test.com',
            'password' => '12345678',
        ]);

        $admin1->assignRole('SuperAdmin');

        $module1 = Module::create([
            'name' => 'Tenant',
        ]);

        $module2 =Module::create([
            'name' => 'Candidate',
        ]);

//      Tenant Permissions
        Permission::create([
            'name' => 'tenant.view',
            'module_id' => $module1->id
        ]);

        Permission::create([
            'name' => 'tenant.edit',
            'module_id' => $module1->id
        ]);

        Permission::create([
            'name' => 'tenant.delete',
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
