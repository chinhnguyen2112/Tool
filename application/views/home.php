<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chào Mừng - MyApp</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome 6 Free -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous">
    <!-- Animate.css for animations -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <!-- Header -->
    <header class="py-3 px-4 bg-white bg-opacity-10 shadow-sm">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="fs-3 fw-bold text-white">MyApp</div>
            <div class="d-flex gap-3">
                <a href="<?= site_url('auth/login') ?>" class="btn btn-outline-light rounded-pill px-4">Đăng Nhập</a>
                <a href="<?= site_url('auth/register') ?>" class="btn btn-light rounded-pill px-4 text-primary">Đăng Ký</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow-1 d-flex align-items-center justify-content-center py-5">
        <div class="container text-center text-white">
            <div class="mx-auto" style="max-width: 800px;">
                <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeInUp">Chào Mừng Đến Với MyApp</h1>
                <p class="lead mb-5 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                    Nền tảng tuyệt vời giúp bạn kết nối, chia sẻ và phát triển. Tham gia cùng hàng ngàn người dùng đã tin tưởng và sử dụng dịch vụ của chúng tôi.
                </p>

                <div class="d-flex justify-content-center gap-3 mb-5 animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                    <a href="<?= site_url('auth/register') ?>" class="btn btn-light btn-lg rounded-pill px-5 text-primary">Bắt Đầu Ngay</a>
                    <a href="<?= site_url('auth/login') ?>" class="btn btn-outline-light btn-lg rounded-pill px-5">Đã Có Tài Khoản</a>
                </div>

                <!-- Features -->
                <div class="row g-4 animate__animated animate__fadeInUp" style="animation-delay: 0.6s;">
                    <div class="col-md-4">
                        <div class="card bg-white bg-opacity-10 text-white h-100 rounded-3 shadow-sm border-0">
                            <div class="card-body p-4">
                                <i class="fa-solid fa-bolt fa-2x mb-3"></i>
                                <h3 class="h5 fw-bold">Nhanh Chóng</h3>
                                <p class="mb-0">Trải nghiệm mượt mà và tốc độ xử lý vượt trội</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-white bg-opacity-10 text-white h-100 rounded-3 shadow-sm border-0">
                            <div class="card-body p-4">
                                <i class="fa-solid fa-lock fa-2x mb-3"></i>
                                <h3 class="h5 fw-bold">Bảo Mật</h3>
                                <p class="mb-0">Dữ liệu của bạn được bảo vệ tuyệt đối</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-white bg-opacity-10 text-white h-100 rounded-3 shadow-sm border-0">
                            <div class="card-body p-4">
                                <i class="fa-solid fa-hand-holding-heart fa-2x mb-3"></i>
                                <h3 class="h5 fw-bold">Dễ Sử Dụng</h3>
                                <p class="mb-0">Giao diện thân thiện, dễ dàng làm quen</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>