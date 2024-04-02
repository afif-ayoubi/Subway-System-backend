<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{

    protected $fillable = [
        'departure_station_id', 'arrival_station_id', 'departure_time', 'arrival_time', 'status'
    ];
    public function departureStation()
    {
        return $this->belongsTo(Station::class, 'departure_station_id');
    }

    public function arrivalStation()
    {
        return $this->belongsTo(Station::class, 'arrival_station_id');
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
