<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table; 
use App\Models\Category; 
use App\Models\Customer; 
use App\Models\Booking; 
use App\Models\Dish; 



class BookingController extends Controller
{
    public function index()
    {
        // Lấy danh sách bàn có sẵn
        $availableTables = Table::where('is_available', true)->get();
        
        // Lấy danh sách món ăn
        $categories = Category::with(['dishes' => function($query) {
            $query->where('is_available', true);
        }])->get();
        
        return view('booking.index', compact('availableTables', 'categories'));
    }
    
    public function store(Request $request)
    {
        // Validate dữ liệu
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'table_id' => 'required|exists:tables,id',
            'booking_time' => 'required|date|after:now',
            'number_of_guests' => 'required|integer|min:1',
            'special_request' => 'nullable|string',
            'dishes' => 'nullable|array',
            'dishes.*.id' => 'exists:dishes,id',
            'dishes.*.quantity' => 'required|integer|min:1',
        ]);
        
        // Tìm khách hàng theo số điện thoại hoặc tạo mới
        $customer = Customer::firstOrCreate(
            ['phone' => $validated['phone']],
            [
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]
        );
        
        // Nếu khách hàng đã tồn tại, tăng số lần ghé thăm
        if (!$customer->wasRecentlyCreated) {
            $customer->increment('visit_count');
        }
        
        // Tạo đặt bàn mới
        $booking = new Booking([
            'table_id' => $validated['table_id'],
            'customer_id' => $customer->id,
            'booking_time' => $validated['booking_time'],
            'number_of_guests' => $validated['number_of_guests'],
            'special_request' => $validated['special_request'] ?? null,
            'status' => 'confirmed',
        ]);
        
        $booking->save();
        
        // Cập nhật trạng thái bàn
        $table = Table::find($validated['table_id']);
        $table->update(['is_available' => false]);
        
        // Thêm món ăn vào đặt bàn
        $totalAmount = 0;
        
        if (!empty($validated['dishes'])) {
            foreach ($validated['dishes'] as $dishData) {
                $dish = Dish::find($dishData['id']);
                $quantity = $dishData['quantity'];
                
                // Thêm món ăn vào booking
                $booking->dishes()->attach($dish->id, [
                    'quantity' => $quantity,
                    'price' => $dish->price
                ]);
                
                // Tính tổng tiền
                $totalAmount += $dish->price * $quantity;
            }
        }
        
        // Cập nhật tổng tiền
        $booking->update(['total_amount' => $totalAmount]);
        
        // Thông báo thành công
        return redirect()->route('booking.success', ['id' => $booking->id])
                         ->with('success', 'Đặt bàn thành công!');
    }
    
    public function success($id)
    {
        $booking = Booking::with(['customer', 'table', 'dishes'])->findOrFail($id);
        return view('booking.success', compact('booking'));
    }

}
