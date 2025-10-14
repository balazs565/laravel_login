<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['user_id', 'service_id', 'timeslot_id','status'];
    public function user(){
    return $this->belongsTo(User::class);
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }
    public function timeslot(){
        return $this->belongsTo(Timeslot::class);
    }
}
