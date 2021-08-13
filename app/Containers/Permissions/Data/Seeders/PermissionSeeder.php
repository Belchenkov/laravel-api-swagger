<?php

namespace App\Containers\Permissions\Data\Seeders;

use App\Containers\Permissions\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            ['name' => 'view_users'],
            ['name' => 'edit_users'],
            ['name' => 'view_roles'],
            ['name' => 'edit_users'],
            ['name' => 'view_products'],
            ['name' => 'edit_products'],
            ['name' => 'view_orders'],
            ['name' => 'edit_orders']
        ]);
    }
}
