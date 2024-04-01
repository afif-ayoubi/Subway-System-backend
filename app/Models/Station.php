<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'manager_id', 'latitude', 'longitude', 'address', 'operating_hours', 'facilities', 'service_status'
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
    public function review(){
        return $this->hasMany(Review::class); 
    }
}
