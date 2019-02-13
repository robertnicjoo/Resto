<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');
        Permission::create(['name' => 'Administer roles & permissions']);
        Permission::create(['name' => 'Create Order']);
        Permission::create(['name' => 'Edit Order']);
        Permission::create(['name' => 'Menus']);
        Permission::create(['name' => 'Employees']);

        $role = Role::create(['name' => 'Manager']);
        $role->givePermissionTo(['Administer roles & permissions', 'Create Order', 'Edit Order', 'Employees', 'Menus']);

        $role = Role::create(['name' => 'Cashier']);
        $role->givePermissionTo(['Create Order', 'Edit Order']);

        $role = Role::create(['name' => 'Waiter']);
    }
}
