<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'image', 
        'category_id', 'is_available'
    ];
    
    // Một món ăn thuộc về một danh mục
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    // Một món ăn thuộc về nhiều đặt bàn
    public function bookings()
    {
        return $this->belongsToMany(Booking::class)
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }
}
