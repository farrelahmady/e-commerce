<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ManagementAccess\Role;
use App\Models\ManagementAccess\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all();

        foreach ($permissions as $permission) {
            $permission->roles()->attach(1);
        }

        $admin_permission = Permission::where('name', "like", 'USER%')->get();

        foreach ($admin_permission as $permission) {
            $permission->roles()->attach(2);
        }
    }
}
