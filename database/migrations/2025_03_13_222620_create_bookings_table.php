<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('table_id')->constrained(); // Liên kết với bảng tables
            $table->foreignId('customer_id')->constrained(); // Liên kết với bảng customers
            $table->dateTime('booking_time'); // Thời gian đặt bàn
            $table->integer('number_of_guests'); // Số lượng khách
            $table->text('special_request')->nullable(); // Yêu cầu đặc biệt
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])
                  ->default('pending');
            $table->decimal('total_amount', 10, 2)->default(0); // Tổng tiền
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
