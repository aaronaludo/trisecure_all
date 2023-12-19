<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RideHistory extends Model
{
    use HasFactory;

    public function passenger(){
        return $this->belongsTo(User::class, 'passenger_id');
    }

    public function driver(){
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }
}
