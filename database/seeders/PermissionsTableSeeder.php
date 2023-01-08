<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 18,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 21,
                'title' => 'doctor_patient_create',
            ],
            [
                'id'    => 22,
                'title' => 'doctor_patient_edit',
            ],
            [
                'id'    => 23,
                'title' => 'doctor_patient_show',
            ],
            [
                'id'    => 24,
                'title' => 'doctor_patient_delete',
            ],
            [
                'id'    => 25,
                'title' => 'doctor_patient_access',
            ],
            [
                'id'    => 26,
                'title' => 'report_create',
            ],
            [
                'id'    => 27,
                'title' => 'report_edit',
            ],
            [
                'id'    => 28,
                'title' => 'report_show',
            ],
            [
                'id'    => 29,
                'title' => 'report_delete',
            ],
            [
                'id'    => 30,
                'title' => 'report_access',
            ],
            [
                'id'    => 31,
                'title' => 'medication_create',
            ],
            [
                'id'    => 32,
                'title' => 'medication_edit',
            ],
            [
                'id'    => 33,
                'title' => 'medication_show',
            ],
            [
                'id'    => 34,
                'title' => 'medication_delete',
            ],
            [
                'id'    => 35,
                'title' => 'medication_access',
            ],
            [
                'id'    => 36,
                'title' => 'test_create',
            ],
            [
                'id'    => 37,
                'title' => 'test_edit',
            ],
            [
                'id'    => 38,
                'title' => 'test_show',
            ],
            [
                'id'    => 39,
                'title' => 'test_delete',
            ],
            [
                'id'    => 40,
                'title' => 'test_access',
            ],
            [
                'id'    => 41,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
