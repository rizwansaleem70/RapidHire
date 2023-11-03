<?php

namespace Database\Seeders\tenant;

use App\Models\User;
use App\Models\Module;
use App\Helpers\Constant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->delete();

        Role::create(['id' => '1', 'name' => 'Admin']);
        Role::create(['id' => '2', 'name' => 'Interviewer']);
        Role::create(['id' => '3', 'name' => 'Recruiter']);
        Role::create(['id' => '4', 'name' => 'User']);

        $admin1 = User::firstOrCreate([
            'email' => 'tenant@rapidhire.com'
        ], [
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'tenant@rapidhire.com',
            'password' => '12345678',
        ]);
        $admin1->assignRole(Constant::ROLE_ADMIN);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
