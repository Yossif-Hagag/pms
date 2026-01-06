<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'edit role']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'delete role']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'create project']);
        Permission::create(['name' => 'edit project']);
        Permission::create(['name' => 'view project']);
        Permission::create(['name' => 'delete project']);
        Permission::create(['name' => 'create task']);
        Permission::create(['name' => 'edit task']);
        Permission::create(['name' => 'view task']);
        Permission::create(['name' => 'delete task']);

        $admin = Role::findByName('admin');
        $admin->givePermissionTo(Permission::all());

        $manager = Role::findByName('manager');
        $manager->givePermissionTo([
            'create project', 'edit project', 'view project',
            'create task', 'edit task', 'view task',
        ]);

        $user = Role::findByName('staff');
        $user->givePermissionTo(['view project', 'view task']);

    }
}
