<?php

namespace App\Modules\Antrian\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //

    protected $table = 'q_reservations';
    protected $guarded = ['id'];

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
}