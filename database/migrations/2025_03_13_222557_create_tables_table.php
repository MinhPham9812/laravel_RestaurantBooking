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
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->string('name');         // Tên bàn (VD: Bàn 1, Bàn VIP 2)
            $table->integer('capacity');    // Số người tối đa
            $table->boolean('is_vip')->default(false); // Bàn VIP hay không
            $table->boolean('is_available')->default(true); // Trạng thái sẵn sàng
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
