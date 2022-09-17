<?php

namespace Database\Seeders;

use App\Handlers\UserTokenHandler;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthorizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdminRole = Role::create(['name' => 'super_admin']);
        $userRole = Role::create(['name' => 'user']);


        $adminCreatePermission = Permission::create(['name' => 'crud:admin']);
        $fileCreatePermission = Permission::create(['name' => 'crud:user']);

        $adminCreatePermission->syncRoles([$superAdminRole]);
        $fileCreatePermission->syncRoles([$superAdminRole, $userRole]);


        $userTokenHandler = new UserTokenHandler();
        $user = $userTokenHandler->createUser('superadmin', 'admin@gmail.com', 'admin123');
        $superadmin = new Admin();
        $superadmin->user_id = $user->id;
        $superadmin->save();
        $user->assignRole('super_admin');
    }
}
