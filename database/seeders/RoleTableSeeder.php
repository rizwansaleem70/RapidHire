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
        Role::create(['id' => '1', 'name' => 'SuperAdmin']);
        Role::create(['id' => '2', 'name' => 'Admin']);
        Role::create(['id' => '3', 'name' => 'Tenant']);
        Role::create(['id' => '4', 'name' => 'SubAdmin']);
        Role::create(['id' => '5', 'name' => 'Interviewer']);
        Role::create(['id' => '6', 'name' => 'Recruiter']);
        Role::create(['id' => '7', 'name' => 'Candidate']);
        $admin1 = User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'admin@rapidhire.com',
            'password' => '12345678',
        ]);

        $admin1->assignRole('SuperAdmin');
        $admin1 = User::create([
            'first_name' => 'Tenant',
            'last_name' => 'Devjeco',
            'email' => 'tenant@gmail.com',
            'password' => '12345678',
        ]);

        $admin1->assignRole('Tenant');
        $admin2 = User::create([
            'first_name' => 'Abdul',
            'last_name' => 'Saboor',
            'email' => 'abdulsaboor6226@gmail.com',
            'password' => 'password',
        ]);

        $admin2->assignRole('Candidate');

        $module1 = Module::create([
            'name' => 'Tenant',
        ]);

        $module2 = Module::create([
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
