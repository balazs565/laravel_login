<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'price', 'duration'];
    public function timeslots()
    {
        return $this->hasMany(Timeslot::class);
    }
}
