<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoinRequest extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'amount', 'status', 'requested_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
 
}
