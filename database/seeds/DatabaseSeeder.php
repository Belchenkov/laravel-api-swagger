<?php

use App\Containers\Order\Data\Seeders\OrderSeeder;
use App\Containers\Permissions\Data\Seeders\PermissionSeeder;
use App\Containers\Permissions\Data\Seeders\RolePermissionSeeder;
use App\Containers\Product\Data\Seeders\ProductSeeder;
use App\Containers\Role\Data\Seeders\RoleSeeder;
use App\Containers\User\Data\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(RoleSeeder::class);
//        $this->call(UserSeeder::class);
//        $this->call(ProductSeeder::class);
//        $this->call(OrderSeeder::class);
//        $this->call(PermissionSeeder::class);
        $this->call(RolePermissionSeeder::class);
    }
}
