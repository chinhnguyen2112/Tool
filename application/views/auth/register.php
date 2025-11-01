<!DOCTYPE html>
<html lang="vi">
<head>
    <base href="<?= base_url() ?>">
    <title>Đăng ký - Hệ thống quản trị</title>
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
    <script>
        var defaultThemeMode = "light"; 
        var themeMode; 
        if (document.documentElement) { 
            themeMode = document.documentElement.hasAttribute("data-bs-theme-mode") 
                ? document.documentElement.getAttribute("data-bs-theme-mode") 
                : localStorage.getItem("data-bs-theme") || defaultThemeMode;
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <style>
        body { background-image: url('assets/media/auth/bg10.jpeg'); } 
        [data-bs-theme="dark"] body { background-image: url('assets/media/auth/bg10-dark.jpeg'); }
    </style>

    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!-- Form -->
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-start p-12">
                <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                            <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" method="post" action="<?= site_url('auth/do_register') ?>">
                                <div class="text-center mb-11">
                                    <h1 class="text-gray-900 fw-bolder mb-3">Đăng ký</h1>
                                    <div class="text-gray-500 fw-semibold fs-6">Tạo tài khoản mới</div>
                                </div>

                                <!-- SUCCESS MESSAGE -->
                                <?php if ($this->session->flashdata('success')): ?>
                                    <div class="alert alert-success alert-dismissible fade show mb-8" role="alert">
                                        <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-check-circle fs-2hx text-success me-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <div><?= $this->session->flashdata('success') ?></div>
                                        </div>
                                        <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"></button>
                                    </div>
                                <?php endif; ?>

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

                                <!-- Email -->
                                <div class="fv-row mb-8">
                                    <input 
                                        type="email" 
                                        placeholder="Email" 
                                        name="email" 
                                        autocomplete="off" 
                                        class="form-control bg-transparent <?= form_error('email') ? 'is-invalid' : '' ?>" 
                                        value="<?= set_value('email') ?>" 
                                        required 
                                    />
                                    <?= form_error('email', '<div class="invalid-feedback">', '</div>') ?>
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

                                <!-- Submit Button -->
                                <div class="d-grid mb-10">
                                    <button type="submit" id="kt_sign_up_submit" class="btn btn-success">
                                        <span class="indicator-label">Đăng ký</span>
                                        <span class="indicator-progress">Vui lòng chờ... 
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>

                                <!-- Link to Login -->
                                <div class="text-gray-500 text-center fw-semibold fs-6">
                                    Đã có tài khoản? 
                                    <a href="<?= site_url('auth/login') ?>" class="link-success fw-bold">Đăng nhập</a>
                                </div>
                            </form>
                        </div>

                        <!-- Footer -->
                        <div class="d-flex flex-stack">
                            <div class="me-10"></div>
                            <div class="d-flex fw-semibold text-primary fs-base gap-5">
                                <a href="#" target="_blank">Điều khoản</a>
                                <a href="#" target="_blank">Liên hệ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aside -->
            <div class="d-flex flex-lg-row-fluid">
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="assets/media/auth/agency.png" alt="" />
                    <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="assets/media/auth/agency-dark.png" alt="" />
                    <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">Hệ thống quản trị</h1>
                    <div class="text-gray-600 fs-base text-center fw-semibold">
                        Đăng ký để bắt đầu sử dụng các tính năng quản lý.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Bundle -->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>

    <!-- Register Script -->
    <script>
        "use strict";
        var KTSignupGeneral = function() {
            var form = document.getElementById('kt_sign_up_form');
            var submitButton = document.getElementById('kt_sign_up_submit');

            return {
                init: function() {
                    if (!form || !submitButton) return;

                    submitButton.addEventListener('click', function(e) {
                        e.preventDefault();
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;
                        submitButton.querySelector('.indicator-label').style.display = 'none';
                        submitButton.querySelector('.indicator-progress').style.display = 'inline-block';

                        setTimeout(() => form.submit(), 500);
                    });
                }
            };
        }();

        KTUtil.onDOMContentLoaded(function() {
            KTSignupGeneral.init();
        });
    </script>
</body>
</html>