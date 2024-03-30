<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    use HasFactory;

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }

    public function reveiws() {
        return $this->hasMany(Review::class);
    }
}
