<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Client']);

        Permission::create(['name' => 'admin.user.index'])->assignRole($role1);
        Permission::create(['name' => 'admin.category.index'])->assignRole($role1);
        Permission::create(['name' => 'admin.product.index'])->assignRole($role1);
        Permission::create(['name' => 'home'])->syncRoles($role1, $role2);
    }
}
