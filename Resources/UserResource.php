<?php

namespace App\Modules\Antrian\Resources;

use App\Libraries\Abstract\Resource;
use App\Modules\Antrian\Models\Organization;
use App\Modules\Antrian\Models\OrganizationUser;
use App\Modules\Base\Models\User;

class UserResource extends Resource
{

    protected static ?string $navigationGroup = 'Antrian';
    protected static ?string $navigationLabel = 'Pengguna';
    protected static ?string $navigationIcon = 'bx bxs-user-badge';
    protected static ?string $slug = 'antrian/users';
    protected static ?string $routeGroup = 'antrian';

    protected static $model = OrganizationUser::class;

    public static function table()
    {
        return [
            'organization.name' => [
                'label' => 'OPD',
                '_searchable' => true
            ],
            'user.name' => [
                'label' => 'Pengguna',
                '_searchable' => false
            ],
            'creator.name' => [
                'label' => 'Dibuat Oleh',
                '_searchable' => true
            ],
            'created_at' => [
                'label' => 'Tanggal Dibuat',
            ],
            '_action'
        ];
    }

    public static function form()
    {
        $organizations = Organization::pluck('name','id');
        $users = User::pluck('name','id');
        return [
            'Form Hari Kerja' => [
                'organization_id' => [
                    'label' => 'OPD',
                    'type' => 'select2',
                    'options' => $organizations,
                    'placeholder' => 'Pilih OPD'
                ],
                'user_id' => [
                    'label' => 'Pengguna',
                    'type' => 'select2',
                    'options' => $users,
                    'placeholder' => 'Pilih Pengguna'
                ],
            ]
        ];
    }

    public static function detail()
    {
        return [
            'Detail' => [
                'organization.name' => 'OPD',
                'user.name' => 'Pengguna',
                'creator.name' => 'Dibuat Oleh',
                'created_at' => 'Tanggal Dibuat',
            ],
        ];
    }

    public static function createRules()
    {
        return [
            'organization_id' => 'required',
            'user_id' => 'required',
        ];
    }
    
    public static function updateRules()
    {
        return [
            'organization_id' => 'required',
            'user_id' => 'required',
        ];
    }
}
