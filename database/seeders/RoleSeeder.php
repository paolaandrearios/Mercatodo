<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::create(['name' => 'administrator']);
        $client = Role::create(['name' => 'client']);
        $stock = Role::create(['name' => 'stock_assistant']);
        $financial = Role::create(['name' => 'financial_assistant']);
        $logistic = Role::create(['name' => 'logistic_assistant']);
        $marketing = Role::create(['name' => 'marketing_assistant']);

        Permission::create(['name' => 'see_admin_menu'])->syncRoles($admin, $stock, $financial,$logistic, $marketing);;
        Permission::create(['name' => 'admin.dashboard.index'])->assignRole($admin);
        Permission::create(['name' => 'admin.user.index'])->assignRole($admin);
        Permission::create(['name' => 'admin.category.index'])->syncRoles($admin, $stock);
        Permission::create(['name' => 'admin.product.index'])->syncRoles($admin, $stock, $financial);
        Permission::create(['name' => 'admin.orders.index'])->syncRoles($admin, $financial, $logistic);
        Permission::create(['name' => 'admin.products.import'])->syncRoles($admin, $stock);
        Permission::create(['name' => 'admin.products.export'])->syncRoles($admin, $stock);
        Permission::create(['name' => 'admin.reports'])->syncRoles($admin, $financial, $marketing);
    }
}
