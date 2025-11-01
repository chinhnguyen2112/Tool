<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chào Mừng - MyApp</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        header {
            padding: 20px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .auth-buttons {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-login {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-login:hover {
            background: white;
            color: #667eea;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .btn-register {
            background: white;
            color: #667eea;
        }

        .btn-register:hover {
            background: #f0f0f0;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        /* Main Content */
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px;
            text-align: center;
        }

        .hero-content {
            max-width: 800px;
            color: white;
        }

        .hero-content h1 {
            font-size: 56px;
            margin-bottom: 20px;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.3);
            animation: fadeInUp 1s ease;
        }

        .hero-content p {
            font-size: 20px;
            margin-bottom: 40px;
            opacity: 0.95;
            line-height: 1.6;
            animation: fadeInUp 1s ease 0.2s both;
        }

        .cta-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            animation: fadeInUp 1s ease 0.4s both;
        }

        .btn-large {
            padding: 18px 45px;
            font-size: 18px;
        }

        /* Features */
        .features {
            display: flex;
            gap: 30px;
            margin-top: 60px;
            animation: fadeInUp 1s ease 0.6s both;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 15px;
            flex: 1;
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.2);
        }

        .feature-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .feature-card h3 {
            font-size: 22px;
            margin-bottom: 10px;
        }

        .feature-card p {
            font-size: 16px;
            opacity: 0.9;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            header {
                padding: 20px;
                flex-direction: column;
                gap: 20px;
            }

            .hero-content h1 {
                font-size: 36px;
            }

            .hero-content p {
                font-size: 18px;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .features {
                flex-direction: column;
            }

            main {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">MyApp</div>
        <div class="auth-buttons">
            <a href="<?= site_url('auth/login') ?>" class="btn btn-login">Đăng Nhập</a>
            <a href="<?= site_url('auth/register') ?>" class="btn btn-register">Đăng Ký</a>
        </div>
    </header>

    <main>
        <div class="hero-content">
            <h1>Chào Mừng Đến Với MyApp</h1>
            <p>Nền tảng tuyệt vời giúp bạn kết nối, chia sẻ và phát triển. Tham gia cùng hàng ngàn người dùng đã tin tưởng và sử dụng dịch vụ của chúng tôi.</p>
            
            <div class="cta-buttons">
                <a href="<?= site_url('auth/register') ?>" class="btn btn-register btn-large">Bắt Đầu Ngay</a>
                <a href="<?= site_url('auth/login') ?>" class="btn btn-login btn-large">Đã Có Tài Khoản</a>
            </div>

            <div class="features">
                <div class="feature-card">
                    <div class="feature-icon">Nhanh</div>
                    <h3>Nhanh Chóng</h3>
                    <p>Trải nghiệm mượt mà và tốc độ xử lý vượt trội</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">Bảo mật</div>
                    <h3>Bảo Mật</h3>
                    <p>Dữ liệu của bạn được bảo vệ tuyệt đối</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">Dễ dùng</div>
                    <h3>Dễ Sử Dụng</h3>
                    <p>Giao diện thân thiện, dễ dàng làm quen</p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>