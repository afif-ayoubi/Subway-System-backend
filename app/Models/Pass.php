<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pass extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'type', 'rides_remaining', 'valid_from', 'valid_until', 'purchased_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
