<?php

namespace App\Modules\Antrian\Resources;

use App\Libraries\Abstract\Resource;
use App\Modules\Antrian\Libraries\Utility;
use App\Modules\Antrian\Models\QueueList;

class QueueListResource extends Resource
{

    protected static ?string $navigationGroup = 'Antrian';
    protected static ?string $navigationLabel = 'List Antrian';
    protected static ?string $navigationIcon = 'bx bx-add-to-queue';
    protected static ?string $slug = 'antrian/lists';
    protected static ?string $routeGroup = 'antrian';

    protected static $model = QueueList::class;

    public static function getModel()
    {
        $organization = Utility::getUserOrganization(auth()->user());
        if($organization)
        {
            return (new static::$model)->where('organization_id', $organization->organization_id);
        }

        return new static::$model;
    }

    public static function table()
    {
        return [
            'organization.name' => [
                'label' => 'OPD',
                '_searchable' => true
            ],
            'queue_number' => [
                'label' => 'No. Antrian',
                '_searchable' => true
            ],
            'record_type' => [
                'label' => 'Jenis Antrian',
                '_searchable' => true
            ],
            'record_status' => [
                'label' => 'Status Antrian',
                '_searchable' => true
            ],
            'created_at' => [
                'label' => 'Tanggal Antrian',
            ],
            '_action'
        ];
    }

    public static function getPages()
    {
        $resource = static::class;
        return [
            'index' => new \App\Libraries\Abstract\Pages\ListPage($resource),
        ];
    }

    public static function listHeader()
    {
        return [
            'title' => static::$navigationLabel,
            'button' => []
        ];
    }

    public static function getAction($d)
    {
        return '-';
    }

}
