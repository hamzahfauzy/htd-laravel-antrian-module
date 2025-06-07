<?php

namespace App\Modules\Antrian\Models;

use App\Modules\Base\Traits\HasActivity;
use App\Modules\Base\Traits\HasCreator;
use Illuminate\Database\Eloquent\Model;

class OrganizationShift extends Model
{
    //
    use HasActivity, HasCreator;

    protected $table = 'q_organization_shifts';
    protected $guarded = ['id'];
    protected $appends = ['hari'];

    protected function getHariAttribute()
    {
        $hari = [
            1 => 'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
        ];
        return $hari[$this->active_day];
    }

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
}