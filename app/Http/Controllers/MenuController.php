<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; 

class MenuController extends Controller
{
    public function index()
    {
        // Lấy tất cả các danh mục món ăn
        $categories = Category::with(['dishes' => function($query) {
            $query->where('is_available', true);
        }])->get();
        
        return view('menu.index', compact('categories'));
    }
}
