<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = ['name', 'capacity', 'is_vip', 'is_available'];
    
    // Một bàn có nhiều lần đặt
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
