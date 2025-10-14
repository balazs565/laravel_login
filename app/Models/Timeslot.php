<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timeslot extends Model
{
    protected $fillable = ['service_id', 'start_time', 'end_time', 'booked'];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'booked' => 'boolean',
    ];
    public function service(){
        return $this->belongsTo(Service::class);
    }
}
