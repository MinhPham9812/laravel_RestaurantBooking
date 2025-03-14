<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish; // Thêm dòng này để import model Dish

class HomeController extends Controller
{
    public function index()
    {
        // Lấy thông tin nhà hàng từ database hoặc config
        $restaurantInfo = [
            'name' => 'Nhà Hàng Ngon',
            'description' => 'Nhà hàng chúng tôi tự hào là điểm đến ẩm thực hàng đầu với các món ăn đặc sắc từ nhiều nền văn hóa ẩm thực khác nhau.',
            'address' => '123 Đường Lê Lợi, Quận 1, TP. Hồ Chí Minh',
            'phone' => '028.1234.5678',
            'opening_hours' => '10:00 - 22:00',
            'email' => 'info@nhahangabc.com',
        ];
        
        // Lấy một số món ăn nổi bật để hiển thị
        $featuredDishes = Dish::where('is_available', true)
                             ->inRandomOrder()
                             ->take(4)
                             ->get();
        
        return view('home.index', compact('restaurantInfo', 'featuredDishes'));
    }
}
