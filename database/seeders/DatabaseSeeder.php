<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tạo tài khoản admin
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_staff' => true,
        ]);
        
        // Tạo danh mục món ăn
        $categories = [
            ['name' => 'Khai vị', 'description' => 'Các món khai vị đặc sắc'],
            ['name' => 'Món chính', 'description' => 'Các món ăn chính đầy đủ dinh dưỡng'],
            ['name' => 'Tráng miệng', 'description' => 'Các món tráng miệng ngọt ngào'],
            ['name' => 'Đồ uống', 'description' => 'Các loại đồ uống giải khát'],
        ];
        
        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
        
        // Tạo các món ăn
        $dishes = [
            ['name' => 'Gỏi cuốn tôm thịt', 'price' => 65000, 'category_id' => 1, 
            'description' => 'Gỏi cuốn tươi mát với tôm, thịt heo, bún và rau sống, ăn kèm nước chấm đặc biệt.'],
            ['name' => 'Chả giò hải sản', 'price' => 55000, 'category_id' => 1,
            'description' => 'Chả giò giòn rụm nhân hải sản thơm ngon.'],
            ['name' => 'Bò lúc lắc', 'price' => 150000, 'category_id' => 2,
            'description' => 'Thịt bò xào với hành tây, ớt chuông, phục vụ cùng salad và cơm chiên.'],
            ['name' => 'Cá hồi sốt chanh dây', 'price' => 175000, 'category_id' => 2,
            'description' => 'Cá hồi tươi áp chảo phủ sốt chanh dây, dùng kèm rau củ theo mùa.'],
            ['name' => 'Bánh flan caramel', 'price' => 45000, 'category_id' => 3,
            'description' => 'Bánh flan mềm mịn với lớp caramel đắng nhẹ.'],
            ['name' => 'Chè hạt sen long nhãn', 'price' => 50000, 'category_id' => 3,
            'description' => 'Chè hạt sen thơm ngon với long nhãn và nước cốt dừa.'],
            ['name' => 'Nước ép cam tươi', 'price' => 45000, 'category_id' => 4,
            'description' => 'Nước ép cam tươi nguyên chất, không đường.'],
            ['name' => 'Sinh tố bơ', 'price' => 55000, 'category_id' => 4,
            'description' => 'Sinh tố bơ đặc creamy với sữa tươi và mật ong.'],
        ];
        
        foreach ($dishes as $dish) {
            \App\Models\Dish::create($dish);
        }
        
        // Tạo các bàn
        for ($i = 1; $i <= 20; $i++) {
            \App\Models\Table::create([
                'name' => 'Bàn ' . $i,
                'capacity' => rand(2, 8),
                'is_vip' => $i > 15, // Bàn 16-20 là bàn VIP
            ]);
        }
    }
}
