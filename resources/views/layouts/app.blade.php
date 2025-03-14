<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Nhà Hàng ABC</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        /* Header styles */
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
        }
        /* Hero section */
        .hero-section {
            height: 500px;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            color: white;
        }
        /* Footer */
        footer {
            background-color: #2c3e50;
            color: white;
            padding: 40px 0;
        }
        /* Menu card */
        .dish-card {
            transition: transform 0.3s;
            margin-bottom: 20px;
        }
        .dish-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        /* Custom button */
        .btn-primary {
            background-color: #e74c3c;
            border-color: #e74c3c;
        }
        .btn-primary:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-utensils me-2"></i>Nhà Hàng ABC
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('menu') ? 'active' : '' }}" href="{{ route('menu') }}">Thực đơn</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('booking.*') ? 'active' : '' }}" href="{{ route('booking.index') }}">Đặt bàn</a>
                    </li>
                    @auth
                        @if(auth()->user()->is_staff)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Quản lý</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">Đăng xuất</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="pt-5 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>Nhà Hàng ABC</h4>
                    <p>Nhà hàng ABC tự hào là điểm đến ẩm thực hàng đầu với các món ăn đặc sắc từ nhiều nền văn hóa ẩm thực khác nhau.</p>
                </div>
                <div class="col-md-4">
                    <h4>Liên hệ</h4>
                    <p><i class="fas fa-map-marker-alt me-2"></i> 123 Đường ABC, Quận 1, TP.HCM</p>
                    <p><i class="fas fa-phone me-2"></i> 028.1234.5678</p>
                    <p><i class="fas fa-envelope me-2"></i> info@nhahangabc.com</p>
                </div>
                <div class="col-md-4">
                    <h4>Giờ mở cửa</h4>
                    <p>Thứ Hai - Thứ Sáu: 10:00 - 22:00</p>
                    <p>Thứ Bảy - Chủ Nhật: 9:00 - 23:00</p>
                    <div class="social-icons mt-3">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <p>&copy; {{ date('Y') }} Nhà Hàng ABC. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>