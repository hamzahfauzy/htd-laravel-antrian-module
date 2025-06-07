<?php

namespace App\Modules\Antrian\Models;

use App\Modules\Base\Traits\HasActivity;
use App\Modules\Base\Traits\HasCreator;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    //
    use HasCreator, HasActivity;

    protected $table = 'q_organizations';
    protected $guarded = ['id'];

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}