<!-- resources/views/menu/index.blade.php -->
@extends('layouts.app')

@section('title', 'Thực đơn')

@section('content')
    <!-- Menu Header -->
    <div class="bg-dark text-white py-5">
        <div class="container text-center">
            <h1 class="display-4">Thực đơn của chúng tôi</h1>
            <p class="lead">Khám phá các món ăn tuyệt vời được chế biến bởi đầu bếp hàng đầu</p>
        </div>
    </div>

    <!-- Menu Categories -->
    <section class="py-5">
        <div class="container">
            <ul class="nav nav-pills mb-5 justify-content-center" id="menu-tabs" role="tablist">
                @foreach($categories as $index => $category)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $index === 0 ? 'active' : '' }}" 
                                id="tab-{{ $category->id }}" 
                                data-bs-toggle="pill" 
                                data-bs-target="#content-{{ $category->id }}" 
                                type="button" 
                                role="tab">
                            {{ $category->name }}
                        </button>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content" id="menu-content">
                @foreach($categories as $index => $category)
                    <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" 
                         id="content-{{ $category->id }}" 
                         role="tabpanel">
                        
                        <h2 class="text-center mb-4">{{ $category->name }}</h2>
                        @if($category->description)
                            <p class="text-center mb-5">{{ $category->description }}</p>
                        @endif

                        <div class="row">
                            @foreach($category->dishes as $dish)
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card dish-card h-100">
                                        <img src="{{ $dish->image ? asset($dish->image) : 'https://via.placeholder.com/300x200?text='.urlencode($dish->name) }}" 
                                             class="card-img-top" 
                                             alt="{{ $dish->name }}">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <h5 class="card-title mb-0">{{ $dish->name }}</h5>
                                                <span class="badge bg-primary">{{ number_format($dish->price) }} VNĐ</span>
                                            </div>
                                            <p class="card-text">{{ $dish->description }}</p>
                                        </div>
                                        <div class="card-footer bg-white">
                                            <a href="{{ route('booking.index', ['dish_id' => $dish->id]) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-utensils me-1"></i> Đặt món này
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="mb-4">Bạn đã sẵn sàng thưởng thức?</h2>
            <p class="lead">Đặt bàn ngay để trải nghiệm ẩm thực tuyệt vời</p>
            <a href="{{ route('booking.index') }}" class="btn btn-primary btn-lg mt-3">Đặt bàn ngay</a>
        </div>
    </section>
@endsection