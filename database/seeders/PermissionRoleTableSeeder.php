<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        $user_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_' && substr($permission->title, 0, 5) != 'role_' && substr($permission->title, 0, 11) != 'permission_';
        });
        $doctor_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_' && substr($permission->title, 0, 5) != 'role_'
                && substr($permission->title, 0, 11) != 'permission_'
                && substr($permission->title, 0, 5) != 'drug_'
                && substr($permission->title, 0, 13) != 'doctor_field_'
                && substr($permission->title, 0, 21) != 'doctor_patient_create'
                && substr($permission->title, 0, 19) != 'doctor_patient_edit';
        });
        Role::findOrFail(2)->permissions()->sync($user_permissions);
        Role::findOrFail(3)->permissions()->sync($doctor_permissions);
    }
}
