<?php

namespace App\Modules\Antrian\Resources;

use App\Libraries\Abstract\Resource;
use App\Modules\Antrian\Models\Organization;
use App\Modules\Antrian\Models\OrganizationShift;

class ShiftResource extends Resource
{

    protected static ?string $navigationGroup = 'Antrian';
    protected static ?string $navigationLabel = 'Hari Kerja';
    protected static ?string $navigationIcon = 'bx bxs-user-check';
    protected static ?string $slug = 'antrian/shifts';
    protected static ?string $routeGroup = 'antrian';

    protected static $model = OrganizationShift::class;

    public static function table()
    {
        return [
            'organization.name' => [
                'label' => 'OPD',
                '_searchable' => true
            ],
            'hari' => [
                'label' => 'Hari',
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
        return [
            'Form Hari Kerja' => [
                'organization_id' => [
                    'label' => 'OPD',
                    'type' => 'select2',
                    'options' => $organizations,
                    'placeholder' => 'Pilih OPD'
                ],
                'active_day' => [
                    'label' => 'Hari Kerja',
                    'type' => 'select',
                    'options' => [
                        1 => 'Senin',
                        'Selasa',
                        'Rabu',
                        'Kamis',
                        'Jumat',
                        'Sabtu',
                        'Minggu'
                    ]
                ],
            ]
        ];
    }

    public static function detail()
    {
        return [
            'Detail' => [
                'organization.name' => 'OPD',
                'hari' => 'Hari Kerja',
                'creator.name' => 'Dibuat Oleh',
                'created_at' => 'Tanggal Dibuat',
            ],
        ];
    }

    public static function createRules()
    {
        return [
            'active_day' => 'required',
        ];
    }
    
    public static function updateRules()
    {
        return [
            'active_day' => 'required',
        ];
    }
}
