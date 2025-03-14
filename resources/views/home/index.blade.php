<!-- resources/views/home/index.blade.php -->
@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
    <!-- Hero Section -->
    <div class="hero-section" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxfDB8MXxhbGx8fHx8fHx8fHwxNjE4NTEwNjU3&ixlib=rb-1.2.1&q=80&w=1080&utm_source=unsplash_source&utm_medium=referral&utm_campaign=api-credit');">
        <div class="container text-center">
            <h1 class="display-3">{{ $restaurantInfo['name'] }}</h1>
            <p class="lead">Trải nghiệm ẩm thực tuyệt vời</p>
            <a href="{{ route('booking.index') }}" class="btn btn-primary btn-lg mt-3">Đặt bàn ngay</a>
        </div>
    </div>

    <!-- About Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="mb-4">Về chúng tôi</h2>
                    <p class="lead">{{ $restaurantInfo['description'] }}</p>
                    <p>Chúng tôi tự hào phục vụ những món ăn ngon nhất, được chế biến từ nguyên liệu tươi ngon và chất lượng cao. Đầu bếp của chúng tôi có hơn 15 năm kinh nghiệm trong nghề và luôn sáng tạo để mang đến những trải nghiệm ẩm thực tuyệt vời nhất.</p>
                    <a href="{{ route('menu') }}" class="btn btn-outline-primary">Xem thực đơn</a>
                </div>
                <div class="col-md-6">
                    <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxfDB8MXxhbGx8fHx8fHx8fHwxNjE4NTEwNjIy&ixlib=rb-1.2.1&q=80&w=1080&utm_source=unsplash_source&utm_medium=referral&utm_campaign=api-credit" alt="Nhà hàng" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Dishes -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Món ăn nổi bật</h2>
            <div class="row">
                @foreach($featuredDishes as $dish)
                    <div class="col-md-3">
                        <div class="card dish-card h-100">
                            <img src="{{ $dish->image ? asset($dish->image) : 'https://via.placeholder.com/300x200?text='.urlencode($dish->name) }}" class="card-img-top" alt="{{ $dish->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $dish->name }}</h5>
                                <p class="card-text">{{ Str::limit($dish->description, 100) }}</p>
                                <p class="text-primary fw-bold">{{ number_format($dish->price) }} VNĐ</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('menu') }}" class="btn btn-primary">Xem tất cả món ăn</a>
            </div>
        </div>
    </section>

    <!-- Location -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="mb-4">Vị trí của chúng tôi</h2>
                    <p><i class="fas fa-map-marker-alt me-2"></i> {{ $restaurantInfo['address'] }}</p>
                    <p><i class="fas fa-phone me-2"></i> {{ $restaurantInfo['phone'] }}</p>
                    <p><i class="fas fa-clock me-2"></i> {{ $restaurantInfo['opening_hours'] }}</p>
                    <p class="mt-4">Nhà hàng tọa lạc tại vị trí đắc địa, dễ dàng tìm thấy với không gian thoáng đãng, sang trọng. Đặc biệt có chỗ đậu xe rộng rãi và an ninh.</p>
                </div>
                <div class="col-md-6">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.4946681007846!2d106.69908361539667!3d10.77118306221414!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f4670702e31%3A0xa5777fb3a4d74676!2sBen%20Thanh%20Market!5e0!3m2!1sen!2s!4v1618511316413!5m2!1sen!2s" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="mb-4">Đặt bàn ngay hôm nay</h2>
            <p class="lead">Đặt bàn trước để được phục vụ tốt nhất và không phải chờ đợi</p>
            <a href="{{ route('booking.index') }}" class="btn btn-light btn-lg mt-3">Đặt bàn ngay</a>
        </div>
    </section>
@endsection