<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'address', 'visit_count'];
    
    // Một khách hàng có thể đặt nhiều lần
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
