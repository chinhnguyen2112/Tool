<!--begin::Wrapper-->
<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div class="container-xxl">

                <!--begin::Welcome Card-->
                <div class="card shadow-sm border-0 mb-7">
                    <div class="card-body d-flex flex-column align-items-center text-center py-20">

                        <!-- Illustration -->
                        <div class="mb-8">
                            <img src="<?= base_url('assets/media/illustrations/sigma-1/20.png') ?>" 
                                 class="mw-100 mh-300px" alt="Welcome">
                        </div>
                        
                        <!-- Text -->
                        <h1 class="fw-bold text-dark mb-3">
                            Xin chào, <span class="text-primary"><?= $username ?></span>!
                        </h1>
                        <p class="text-gray-600 fs-5 mb-8">
                            Chào mừng đến với <strong>Trang Quản Trị Hệ Thống</strong>.<br>
                            Bắt đầu quản lý và khám phá ngay!
                        </p>

                        <!-- Button -->
                        <a href="<?= site_url('admin/users') ?>" 
                           class="btn btn-primary btn-lg px-8 py-3 fw-bold">
                            <i class="ki-outline ki-user fs-2 me-2"></i>
                            Quản lý người dùng
                        </a>
                    </div>
                </div>
                <!--end::Welcome Card-->

            </div>
        </div>
        <!--end::Post-->

        <!--begin::Footer-->
        <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
            <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                <div class="text-dark order-2 order-md-1">
                    <span class="text-muted fw-semibold me-1">2025©</span>
                    <a href="https://keenthemes.com" target="_blank" class="text-gray-800 text-hover-primary">Keenthemes</a>
                </div>
            </div>
        </div>
        <!--end::Footer-->

    </div>
    <!--end::Content-->
</div>
<!--end::Wrapper-->