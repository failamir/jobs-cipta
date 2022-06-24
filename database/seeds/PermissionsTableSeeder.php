<?php

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
                'title' => 'job_create',
            ],
            [
                'id'    => 18,
                'title' => 'job_edit',
            ],
            [
                'id'    => 19,
                'title' => 'job_show',
            ],
            [
                'id'    => 20,
                'title' => 'job_delete',
            ],
            [
                'id'    => 21,
                'title' => 'job_access',
            ],
            [
                'id'    => 22,
                'title' => 'registration_flow_create',
            ],
            [
                'id'    => 23,
                'title' => 'registration_flow_edit',
            ],
            [
                'id'    => 24,
                'title' => 'registration_flow_show',
            ],
            [
                'id'    => 25,
                'title' => 'registration_flow_delete',
            ],
            [
                'id'    => 26,
                'title' => 'registration_flow_access',
            ],
            [
                'id'    => 27,
                'title' => 'applied_job_create',
            ],
            [
                'id'    => 28,
                'title' => 'applied_job_edit',
            ],
            [
                'id'    => 29,
                'title' => 'applied_job_show',
            ],
            [
                'id'    => 30,
                'title' => 'applied_job_delete',
            ],
            [
                'id'    => 31,
                'title' => 'applied_job_access',
            ],
            [
                'id'    => 32,
                'title' => 'resume_create',
            ],
            [
                'id'    => 33,
                'title' => 'resume_edit',
            ],
            [
                'id'    => 34,
                'title' => 'resume_show',
            ],
            [
                'id'    => 35,
                'title' => 'resume_delete',
            ],
            [
                'id'    => 36,
                'title' => 'resume_access',
            ],
            [
                'id'    => 37,
                'title' => 'meeting_create',
            ],
            [
                'id'    => 38,
                'title' => 'meeting_edit',
            ],
            [
                'id'    => 39,
                'title' => 'meeting_show',
            ],
            [
                'id'    => 40,
                'title' => 'meeting_delete',
            ],
            [
                'id'    => 41,
                'title' => 'meeting_access',
            ],
            [
                'id'    => 42,
                'title' => 'job_alert_create',
            ],
            [
                'id'    => 43,
                'title' => 'job_alert_edit',
            ],
            [
                'id'    => 44,
                'title' => 'job_alert_show',
            ],
            [
                'id'    => 45,
                'title' => 'job_alert_delete',
            ],
            [
                'id'    => 46,
                'title' => 'job_alert_access',
            ],
            [
                'id'    => 47,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 48,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 49,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 50,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 51,
                'title' => 'job_position_create',
            ],
            [
                'id'    => 52,
                'title' => 'job_position_edit',
            ],
            [
                'id'    => 53,
                'title' => 'job_position_show',
            ],
            [
                'id'    => 54,
                'title' => 'job_position_delete',
            ],
            [
                'id'    => 55,
                'title' => 'job_position_access',
            ],
            [
                'id'    => 56,
                'title' => 'data_preparation_create',
            ],
            [
                'id'    => 57,
                'title' => 'data_preparation_edit',
            ],
            [
                'id'    => 58,
                'title' => 'data_preparation_show',
            ],
            [
                'id'    => 59,
                'title' => 'data_preparation_delete',
            ],
            [
                'id'    => 60,
                'title' => 'data_preparation_access',
            ],
            [
                'id'    => 61,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
