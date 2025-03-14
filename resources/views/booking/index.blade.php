<!-- resources/views/booking/index.blade.php -->
@extends('layouts.app')

@section('title', 'Đặt bàn')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
    <!-- Booking Header -->
    <div class="bg-dark text-white py-5">
        <div class="container text-center">
            <h1 class="display-4">Đặt bàn</h1>
            <p class="lead">Đặt bàn trước để có trải nghiệm tốt nhất</p>
        </div>
    </div>

    <!-- Booking Form -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card shadow">
                        <div class="card-body p-5">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('booking.store') }}" method="POST">
                                @csrf
                                
                                <h4 class="mb-4">Thông tin khách hàng</h4>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Họ tên</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Số điện thoại</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                        <div class="form-text">Chúng tôi sẽ gửi xác nhận đặt bàn qua email này</div>
                                    </div>
                                </div>

                                <hr class="my-4">
                                
                                <h4 class="mb-4">Chi tiết đặt bàn</h4>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="booking_time" class="form-label">Thời gian</label>
                                        <input type="text" class="form-control" id="booking_time" name="booking_time" placeholder="Chọn ngày và giờ" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="number_of_guests" class="form-label">Số lượng khách</label>
                                        <select class="form-select" id="number_of_guests" name="number_of_guests" required>
                                            @for($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}" {{ old('number_of_guests') == $i ? 'selected' : '' }}>{{ $i }} người</option>
                                            @endfor
                                            <option value="11">Trên 10 người</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="table_id" class="form-label">Chọn bàn</label>
                                        <select class="form-select" id="table_id" name="table_id" required>
                                            <option value="">-- Chọn bàn --</option>
                                            @foreach($availableTables as $table)
                                                <option value="{{ $table->id }}" {{ old('table_id') == $table->id ? 'selected' : '' }}>
                                                    {{ $table->name }} ({{ $table->capacity }} người{{ $table->is_vip ? ', VIP' : '' }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="special_request" class="form-label">Yêu cầu đặc biệt</label>
                                        <textarea class="form-control" id="special_request" name="special_request" rows="3">{{ old('special_request') }}</textarea>
                                    </div>
                                </div>

                                <hr class="my-4">
                                
                                <h4 class="mb-4">Đặt món trước (tùy chọn)</h4>
                                
                                <div class="accordion" id="dishAccordion">
                                    @foreach($categories as $category)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading{{ $category->id }}">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $category->id }}">
                                                    {{ $category->name }}
                                                </button>
                                            </h2>
                                            <div id="collapse{{ $category->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $category->id }}" data-bs-parent="#dishAccordion">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        @foreach($category->dishes as $dish)
                                                            <div class="col-md-6 mb-3">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input dish-checkbox" 
                                                                               type="checkbox" 
                                                                               id="dish{{ $dish->id }}" 
                                                                               data-dish-id="{{ $dish->id }}"
                                                                               data-dish-price="{{ $dish->price }}">
                                                                        <label class="form-check-label" for="dish{{ $dish->id }}">
                                                                            {{ $dish->name }} ({{ number_format($dish->price) }} VNĐ)
                                                                        </label>
                                                                    </div>
                                                                    <div class="dish-quantity ms-auto" style="display: none;">
                                                                        <div class="input-group input-group-sm" style="width: 120px;">
                                                                            <button type="button" class="btn btn-outline-secondary quantity-btn minus">-</button>
                                                                            <input type="number" class="form-control text-center quantity-input" 
                                                                                   name="dishes[{{ $dish->id }}][quantity]" value="1" min="1" max="10">
                                                                            <button type="button" class="btn btn-outline-secondary quantity-btn plus">+</button>
                                                                            <input type="hidden" name="dishes[{{ $dish->id }}][id]" value="{{ $dish->id }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6 offset-md-6">
                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <h5 class="card-title">Tóm tắt đặt món</h5>
                                                <div id="orderSummary">
                                                    <p class="text-muted">Chưa có món ăn nào được chọn</p>
                                                </div>
                                                <div class="d-flex justify-content-between mt-3">
                                                    <strong>Tổng cộng:</strong>
                                                    <strong id="totalAmount">0 VNĐ</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">Đặt bàn</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // Khởi tạo datetime picker
        flatpickr("#booking_time", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: "today",
            minTime: "10:00",
            maxTime: "21:00",
            defaultHour: 18,
            defaultMinute: 0
        });

        // Xử lý chọn món
        document.addEventListener('DOMContentLoaded', function() {
            // Lấy tất cả các checkbox món ăn
            const dishCheckboxes = document.querySelectorAll('.dish-checkbox');
            
            // Thêm event listener cho mỗi checkbox
            dishCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const dishId = this.dataset.dishId;
                    const quantityContainer = this.closest('.d-flex').querySelector('.dish-quantity');
                    
                    if (this.checked) {
                        quantityContainer.style.display = 'block';
                    } else {
                        quantityContainer.style.display = 'none';
                    }
                    
                    updateOrderSummary();
                });
            });
            
            // Xử lý nút tăng/giảm số lượng
            document.querySelectorAll('.quantity-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.parentElement.querySelector('.quantity-input');
                    const currentValue = parseInt(input.value);
                    
                    if (this.classList.contains('plus')) {
                        input.value = currentValue + 1;
                    } else if (this.classList.contains('minus') && currentValue > 1) {
                        input.value = currentValue - 1;
                    }
                    
                    updateOrderSummary();
                });
            });
            
            // Cập nhật tóm tắt đặt món
            function updateOrderSummary() {
                const orderSummary = document.getElementById('orderSummary');
                const totalAmount = document.getElementById('totalAmount');
                
                let summary = '';
                let total = 0;
                let hasItems = false;
                
                dishCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        hasItems = true;
                        const dishId = checkbox.dataset.dishId;
                        const dishName = checkbox.nextElementSibling.textContent.split('(')[0].trim();
                        const dishPrice = parseFloat(checkbox.dataset.dishPrice);
                        const quantity = parseInt(checkbox.closest('.d-flex').querySelector('.quantity-input').value);
                        const itemTotal = dishPrice * quantity;
                        
                        summary += `<div class="d-flex justify-content-between mb-2">
                                        <span>${dishName} x ${quantity}</span>
                                        <span>${itemTotal.toLocaleString('vi-VN')} VNĐ</span>
                                    </div>`;
                        
                        total += itemTotal;
                    }
                });
                
                if (hasItems) {
                    orderSummary.innerHTML = summary;
                    totalAmount.textContent = `${total.toLocaleString('vi-VN')} VNĐ`;
                } else {
                    orderSummary.innerHTML = '<p class="text-muted">Chưa có món ăn nào được chọn</p>';
                    totalAmount.textContent = '0 VNĐ';
                }
            }
        });
    </script>
@endsection