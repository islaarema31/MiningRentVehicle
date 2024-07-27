<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_name',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
    public function order()
    {
        return $this->hasMany(Order::class, 'driver_id');
    }
}
