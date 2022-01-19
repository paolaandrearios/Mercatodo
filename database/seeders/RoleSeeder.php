<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Client']);

        Permission::create(['name' => 'user.index'])->assignRole($role1);
        Permission::create(['name' => 'category.index'])->assignRole($role1);
        Permission::create(['name' => 'home'])->syncRoles($role1, $role2);
    }
}