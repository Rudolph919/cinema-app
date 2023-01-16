<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Permission::create(['name' => 'create-cinema-company']);
        Permission::create(['name' => 'edit-cinema-company']);
        Permission::create(['name' => 'delete-cinema-company']);

        Permission::create(['name' => 'create-cinema']);
        Permission::create(['name' => 'edit-cinema']);
        Permission::create(['name' => 'delete-cinema']);

        Permission::create(['name' => 'create-theatre']);
        Permission::create(['name' => 'edit-theatre']);
        Permission::create(['name' => 'delete-theatre']);

        Permission::create(['name' => 'create-film']);
        Permission::create(['name' => 'edit-film']);
        Permission::create(['name' => 'delete-film']);

        Permission::create(['name' => 'create-show-time']);
        Permission::create(['name' => 'edit-show-time']);
        Permission::create(['name' => 'delete-show-time']);

        Permission::create(['name' => 'create-booking']);
        Permission::create(['name' => 'edit-booking']);
        Permission::create(['name' => 'delete-booking']);

        $adminRole = Role::create([
            'name' => 'Admin',
        ]);

        $adminRole->givePermissionTo([
            'create-cinema-company',
            'edit-cinema-company',
            'delete-cinema-company',
            'create-cinema',
            'edit-cinema',
            'delete-cinema',
            'create-theatre',
            'edit-theatre',
            'delete-theatre',
            'create-film',
            'edit-film',
            'delete-film',
            'create-show-time',
            'edit-show-time',
            'delete-show-time',
        ]);

        $userRole = Role::create([
            'name' => 'User',
        ]);

        $userRole->givePermissionTo([
            'create-booking',
            'edit-booking',
            'delete-booking'
        ]);
    }
}
