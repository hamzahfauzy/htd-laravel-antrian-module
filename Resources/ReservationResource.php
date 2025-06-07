<?php

namespace App\Modules\Antrian\Resources;

use App\Libraries\Abstract\Resource;
use App\Modules\Antrian\Models\Reservation;

class ReservationResource extends Resource
{

    protected static ?string $navigationGroup = 'Antrian';
    protected static ?string $navigationLabel = 'Reservasi';
    protected static ?string $navigationIcon = 'bx bx-file';
    protected static ?string $slug = 'antrian/reservations';
    protected static ?string $routeGroup = 'antrian';

    protected static $model = Reservation::class;

    public static function table()
    {
        return [
            'organization.name' => [
                'label' => 'OPD',
                '_searchable' => true
            ],
            'code' => [
                'label' => 'Kode',
                '_searchable' => true
            ],
            'name' => [
                'label' => 'Nama',
                '_searchable' => true
            ],
            'phone' => [
                'label' => 'No. HP',
                '_searchable' => true
            ],
            'date' => [
                'label' => 'Tanggal Reservasi',
                '_searchable' => true
            ],
            'queue.queue_number' => [
                'label' => 'No. Antrian',
                '_searchable' => true
            ],
            'record_type' => [
                'label' => 'Jenis Reservasi',
                '_searchable' => true
            ],
            'record_status' => [
                'label' => 'Status Reservasi',
                '_searchable' => true
            ],
            'created_at' => [
                'label' => 'Tanggal Dibuat',
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

}
