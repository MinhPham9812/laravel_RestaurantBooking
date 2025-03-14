<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description'];
    
    // Một danh mục có nhiều món ăn
    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }
}
