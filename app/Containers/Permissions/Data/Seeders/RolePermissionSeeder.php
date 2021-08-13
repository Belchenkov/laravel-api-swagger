<?php
namespace App\Containers\Permissions\Data\Seeders;


use App\Containers\Permissions\Models\Permission;
use App\Containers\Role\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perms = Permission::all();

        $admin = Role::whereName('admin')->first();
        foreach ($perms as $perm) {
            DB::table('role_permissions')->insert([
                'role_id' => $admin->id,
                'permission_id' => $perm->id,
            ]);
        }

        $editor = Role::whereName('editor')->first();
        foreach ($perms as $perm) {
            if ($perm->name == 'edit_roles') {
                DB::table('role_permissions')->insert([
                    'role_id' => $editor->id,
                    'permission_id' => $perm->id,
                ]);
            }
        }

        $viewer = Role::whereName('viewer')->first();
        $viewer_roles = [
            'view_users',
            'view_roles',
            'view_products',
            'view_orders'
        ];

        foreach ($perms as $perm) {
            if (in_array($perm->name, $viewer_roles)) {
                DB::table('role_permissions')->insert([
                    'role_id' => $viewer->id,
                    'permission_id' => $perm->id,
                ]);
            }
        }
    }
}
