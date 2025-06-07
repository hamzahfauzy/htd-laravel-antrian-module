<?php

namespace App\Modules\Antrian\Resources;

use App\Libraries\Abstract\Resource;
use App\Modules\Antrian\Libraries\Utility;
use App\Modules\Antrian\Models\Organization;

class OrganizationResource extends Resource
{

    protected static ?string $navigationGroup = 'Antrian';
    protected static ?string $navigationLabel = 'OPD';
    protected static ?string $navigationIcon = 'bx bx-category';
    protected static ?string $slug = 'antrian/organizations';
    protected static ?string $routeGroup = 'antrian';

    protected static $model = Organization::class;

    public static function table()
    {
        return [
            'initial_name' => [
                'label' => 'Inisial',
                '_searchable' => true
            ],
            'name' => [
                'label' => 'Nama',
                '_searchable' => true
            ],
            'service_status' => [
                'label' => 'Antrian Online/Reservasi',
                '_searchable' => true
            ],
            'queue_limit' => [
                'label' => 'Limit Antrian',
                '_searchable' => true
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
        return [
            'Form OPD' => [
                'initial_name' => [
                    'label' => 'Inisial',
                    'type' => 'text',
                    'placeholder' => 'Masukkan Inisial OPD'
                ],
                'name' => [
                    'label' => 'Nama',
                    'type' => 'text',
                    'placeholder' => 'Masukkan Nama OPD'
                ],
                'service_status' => [
                    'label' => 'Antrian Online/Reservasi',
                    'type' => 'select',
                    'options' => [
                        'Aktif' => 'Aktif',
                        'Tidak Aktif' => 'Tidak Aktif',
                    ],
                    'required' => true,
                ],
                'queue_limit' => [
                    'label' => 'Limit Antrian',
                    'type' => 'number',
                    'placeholder' => 'Masukkan Limit Antrian'
                ],
            ]
        ];
    }

    public static function detail()
    {
        return [
            'Detail' => [
                'initial_name' => 'Inisial',
                'name' => 'Nama',
                'service_status' => 'Antrian Online/Reservasi',
                'queue_limit' => 'Limit Antrian',
                'creator.name' => 'Dibuat Oleh',
                'created_at' => 'Tanggal Dibuat',
            ],
        ];
    }

    public static function createRules()
    {
        return [
            'initial_name' => 'required|sometimes|unique:q_organizations',
            'name' => 'required',
            'service_status' => 'required',
            'queue_limit' => 'required',
        ];
    }
    
    public static function updateRules()
    {
        return [
            'initial_name' => 'required|sometimes|unique:q_organizations',
            'name' => 'required',
            'service_status' => 'required',
            'queue_limit' => 'required',
        ];
    }
}
