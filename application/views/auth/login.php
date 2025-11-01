<!DOCTYPE html>
<html lang="vi">
<head>
    <base href="<?= base_url() ?>">
    <title>Đăng nhập - Hệ thống quản trị</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <script>
        if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>
</head>
<body id="kt_body" class="auth-bg bgi-size-cover bgi-attachment-fixed bgi-position-center">
    <style>
        body { background-image: url('assets/media/auth/bg10.jpeg'); } 
        [data-bs-theme="dark"] body { background-image: url('assets/media/auth/bg10-dark.jpeg'); }

        .btn-primary {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4) !important; /* Màu xanh primary */
            background-color: #3699ff !important; /* Màu hover sâu hơn */
        }

        .btn-primary .indicator-progress {
            display: none;
        }

        .btn-primary[data-kt-indicator="on"] .indicator-label {
            display: none;
        }

        .btn-primary[data-kt-indicator="on"] .indicator-progress {
            display: inline-block;
        }

        /* CẢI THIỆN ALERT: Icon đẹp hơn */
        .alert .ki-duotone {
            font-size: 1.5rem;
        }
    </style>

    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!-- Aside -->
            <div class="d-flex flex-lg-row-fluid">
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="assets/media/auth/agency.png" alt="" />
                    <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="assets/media/auth/agency-dark.png" alt="" />
                    <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">Hệ thống quản trị</h1>
                    <div class="text-gray-600 fs-base text-center fw-semibold">Đăng nhập để tiếp tục sử dụng các tính năng quản lý.</div>
                </div>
            </div>

            <!-- Form -->
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                            <form class="form w-100" method="post" action="<?= site_url('auth/do_login') ?>">
                                <div class="text-center mb-11">
                                    <h1 class="text-gray-900 fw-bolder mb-3">Đăng nhập</h1>
                                    <div class="text-gray-500 fw-semibold fs-6">Nhập thông tin tài khoản</div>
                                </div>

                                <!-- ERROR MESSAGE -->
                                <?php if ($this->session->flashdata('error')): ?>
                                    <div class="alert alert-danger alert-dismissible fade show mb-8" role="alert">
                                        <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-warning-triangle fs-2hx text-danger me-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <div><?= $this->session->flashdata('error') ?></div>
                                        </div>
                                        <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"></button>
                                    </div>
                                <?php endif; ?>

                                <!-- Username -->
                                <div class="fv-row mb-8">
                                    <input 
                                        type="text" 
                                        placeholder="Tên đăng nhập" 
                                        name="username" 
                                        autocomplete="off" 
                                        class="form-control bg-transparent <?= form_error('username') ? 'is-invalid' : '' ?>" 
                                        value="<?= set_value('username') ?>" 
                                        required 
                                    />
                                    <?= form_error('username', '<div class="invalid-feedback">', '</div>') ?>
                                </div>

                                <!-- Password -->
                                <div class="fv-row mb-3">
                                    <input 
                                        type="password" 
                                        placeholder="Mật khẩu" 
                                        name="password" 
                                        autocomplete="off" 
                                        class="form-control bg-transparent <?= form_error('password') ? 'is-invalid' : '' ?>" 
                                        required 
                                    />
                                    <?= form_error('password', '<div class="invalid-feedback">', '</div>') ?>
                                </div>

                                <!-- Quên mật khẩu -->
                                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                    <div></div>
                                    <a href="#" class="link-primary">Quên mật khẩu?</a>
                                </div>

                                <!-- Nút Đăng nhập (ĐÃ SỬA HOVER) -->
                                <div class="d-grid mb-10">
                                    <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                        <span class="indicator-label">Đăng nhập</span>
                                        <span class="indicator-progress">Vui lòng chờ... 
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>

                                <!-- Link đăng ký -->
                                <div class="text-gray-500 text-center fw-semibold fs-6">
                                    Chưa có tài khoản? 
                                    <a href="<?= site_url('auth/register') ?>" class="link-primary fw-bold">Đăng ký</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Bundle -->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>

    <!-- Login Script (mượt hơn) -->
    <script>
        "use strict";
        var KTSigninGeneral = function() {
            var form = document.querySelector('.form');
            var submitButton = document.getElementById('kt_sign_in_submit');

            return {
                init: function() {
                    if (!form || !submitButton) return;

                    submitButton.addEventListener('click', function(e) {
                        e.preventDefault();

                        // Kiểm tra validation HTML5
                        if (!form.checkValidity()) {
                            form.reportValidity();
                            return;
                        }

                        // Hiệu ứng loading
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;

                        setTimeout(() => {
                            form.submit();
                        }, 600);
                    });
                }
            };
        }();

        KTUtil.onDOMContentLoaded(function() {
            KTSigninGeneral.init();
        });
    </script>
</body>
</html>