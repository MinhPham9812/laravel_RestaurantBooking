<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking; 
use App\Models\Customer; 
use Illuminate\Support\Facades\DB; // Thêm dòng này để import DB facade


class DashboardController extends Controller
{
    public function index()
    {
        // Thống kê tổng quan
        $stats = [
            'total_bookings' => Booking::count(),
            'today_bookings' => Booking::whereDate('created_at', today())->count(),
            'total_revenue' => Booking::sum('total_amount'),
            'today_revenue' => Booking::whereDate('created_at', today())->sum('total_amount'),
            'total_customers' => Customer::count(),
            'loyal_customers' => Customer::where('visit_count', '>=', 3)->count(),
        ];
        
        // Top 5 món ăn được đặt nhiều nhất
        $topDishes = DB::table('booking_dish')
            ->join('dishes', 'booking_dish.dish_id', '=', 'dishes.id')
            ->select('dishes.name', DB::raw('SUM(booking_dish.quantity) as total_ordered'))
            ->groupBy('dishes.id', 'dishes.name')
            ->orderBy('total_ordered', 'desc')
            ->take(5)
            ->get();
        
        // Doanh thu 7 ngày gần đây
        $recentRevenue = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = today()->subDays($i);
            $recentRevenue[] = [
                'date' => $date->format('d/m'),
                'revenue' => Booking::whereDate('created_at', $date)->sum('total_amount')
            ];
        }
        
        return view('admin.dashboard', compact('stats', 'topDishes', 'recentRevenue'));
    }

}
