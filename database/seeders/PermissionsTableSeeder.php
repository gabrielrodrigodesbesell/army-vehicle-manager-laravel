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
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'grupo_create',
            ],
            [
                'id'    => 20,
                'title' => 'grupo_edit',
            ],
            [
                'id'    => 21,
                'title' => 'grupo_show',
            ],
            [
                'id'    => 22,
                'title' => 'grupo_delete',
            ],
            [
                'id'    => 23,
                'title' => 'grupo_access',
            ],
            [
                'id'    => 24,
                'title' => 'secao_create',
            ],
            [
                'id'    => 25,
                'title' => 'secao_edit',
            ],
            [
                'id'    => 26,
                'title' => 'secao_show',
            ],
            [
                'id'    => 27,
                'title' => 'secao_delete',
            ],
            [
                'id'    => 28,
                'title' => 'secao_access',
            ],
            [
                'id'    => 29,
                'title' => 'veiculo_create',
            ],
            [
                'id'    => 30,
                'title' => 'veiculo_edit',
            ],
            [
                'id'    => 31,
                'title' => 'veiculo_show',
            ],
            [
                'id'    => 32,
                'title' => 'veiculo_delete',
            ],
            [
                'id'    => 33,
                'title' => 'veiculo_access',
            ],
            [
                'id'    => 39,
                'title' => 'graduacao_create',
            ],
            [
                'id'    => 40,
                'title' => 'graduacao_edit',
            ],
            [
                'id'    => 41,
                'title' => 'graduacao_show',
            ],
            [
                'id'    => 42,
                'title' => 'graduacao_delete',
            ],
            [
                'id'    => 43,
                'title' => 'graduacao_access',
            ],
            [
                'id'    => 44,
                'title' => 'asset_management_access',
            ],
            [
                'id'    => 45,
                'title' => 'asset_category_create',
            ],
            [
                'id'    => 46,
                'title' => 'asset_category_edit',
            ],
            [
                'id'    => 47,
                'title' => 'asset_category_show',
            ],
            [
                'id'    => 48,
                'title' => 'asset_category_delete',
            ],
            [
                'id'    => 49,
                'title' => 'asset_category_access',
            ],
            [
                'id'    => 50,
                'title' => 'asset_location_create',
            ],
            [
                'id'    => 51,
                'title' => 'asset_location_edit',
            ],
            [
                'id'    => 52,
                'title' => 'asset_location_show',
            ],
            [
                'id'    => 53,
                'title' => 'asset_location_delete',
            ],
            [
                'id'    => 54,
                'title' => 'asset_location_access',
            ],
            [
                'id'    => 55,
                'title' => 'asset_status_create',
            ],
            [
                'id'    => 56,
                'title' => 'asset_status_edit',
            ],
            [
                'id'    => 57,
                'title' => 'asset_status_show',
            ],
            [
                'id'    => 58,
                'title' => 'asset_status_delete',
            ],
            [
                'id'    => 59,
                'title' => 'asset_status_access',
            ],
            [
                'id'    => 60,
                'title' => 'asset_create',
            ],
            [
                'id'    => 61,
                'title' => 'asset_edit',
            ],
            [
                'id'    => 62,
                'title' => 'asset_show',
            ],
            [
                'id'    => 63,
                'title' => 'asset_delete',
            ],
            [
                'id'    => 64,
                'title' => 'asset_access',
            ],
            [
                'id'    => 65,
                'title' => 'assets_history_access',
            ],
            [
                'id'    => 66,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 67,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 68,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 69,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 70,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 71,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 72,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 73,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 74,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 75,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 76,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 77,
                'title' => 'task_create',
            ],
            [
                'id'    => 78,
                'title' => 'task_edit',
            ],
            [
                'id'    => 79,
                'title' => 'task_show',
            ],
            [
                'id'    => 80,
                'title' => 'task_delete',
            ],
            [
                'id'    => 81,
                'title' => 'task_access',
            ],
            [
                'id'    => 82,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 83,
                'title' => 'codigo_qr_create',
            ],
            [
                'id'    => 84,
                'title' => 'codigo_qr_edit',
            ],
            [
                'id'    => 85,
                'title' => 'codigo_qr_show',
            ],
            [
                'id'    => 86,
                'title' => 'codigo_qr_delete',
            ],
            [
                'id'    => 87,
                'title' => 'codigo_qr_access',
            ],
            [
                'id'    => 93,
                'title' => 'io_access',
            ],
            [
                'id'    => 94,
                'title' => 'io_pessoa_create',
            ],
            [
                'id'    => 95,
                'title' => 'io_pessoa_edit',
            ],
            [
                'id'    => 96,
                'title' => 'io_pessoa_show',
            ],
            [
                'id'    => 97,
                'title' => 'io_pessoa_delete',
            ],
            [
                'id'    => 98,
                'title' => 'io_pessoa_access',
            ],
            [
                'id'    => 99,
                'title' => 'io_veiculo_create',
            ],
            [
                'id'    => 100,
                'title' => 'io_veiculo_edit',
            ],
            [
                'id'    => 101,
                'title' => 'io_veiculo_show',
            ],
            [
                'id'    => 102,
                'title' => 'io_veiculo_delete',
            ],
            [
                'id'    => 103,
                'title' => 'io_veiculo_access',
            ],
            [
                'id'    => 104,
                'title' => 'profile_password_edit',
            ],
            [
                'id'    => 105,
                'title' => 'cadastrador_soldados',
            ],
            [
                'id'    => 106,
                'title' => 'exibir_responsavel_lista',
            ],
            [
                'id'    => 107,
                'title' => 'cadastro_pessoa_sem_login',
            ],
        ];
        Permission::insert($permissions);
    }
}
