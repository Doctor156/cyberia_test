<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class PermissionsSeeder extends Seeder
{
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'all']);
        $permission->assignRole($admin);

        User::find(1)->assignRole('admin');
    }
}
