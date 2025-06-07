<?php

namespace App\Modules\Antrian\Models;

use App\Modules\Base\Traits\HasActivity;
use Illuminate\Database\Eloquent\Model;

class QueueList extends Model
{
    //
    use HasActivity;

    protected $table = 'q_lists';
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

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
}