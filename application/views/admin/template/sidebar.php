<!--begin::Aside-->
<div id="kt_aside" class="aside aside-dark aside-hoverable" 
     data-kt-drawer="true" 
     data-kt-drawer-name="aside" 
     data-kt-drawer-activate="{default: true, lg: false}" 
     data-kt-drawer-overlay="true" 
     data-kt-drawer-width="{default:'200px', '300px': '250px'}" 
     data-kt-drawer-direction="start" 
     data-kt-drawer-toggle="#kt_aside_mobile_toggle">

    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto pt-5 pb-3 px-6" id="kt_aside_logo">
        <a href="<?= site_url('admin/admin_dashboard') ?>">
            <img alt="Logo" src="<?= base_url('assets/media/logos/demo13.svg') ?>" class="h-25px logo" />
        </a>
        <div id="kt_aside_toggle" 
             class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" 
             data-kt-toggle="true" 
             data-kt-toggle-state="active" 
             data-kt-toggle-target="body" 
             data-kt-toggle-name="aside-minimize">
            <i class="ki-outline ki-double-left fs-1"></i>
        </div>
    </div>
    <!--end::Brand-->

    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
        <div id="kt_aside_menu_wrapper" 
             class="hover-scroll-overlay-y my-5 my-lg-5" 
             data-kt-scroll="true" 
             data-kt-scroll-activate="{default: false, lg: true}" 
             data-kt-scroll-height="auto" 
             data-kt-scroll-dependencies="#kt_aside_logo" 
             data-kt-scroll-wrappers="#kt_aside_menu" 
             data-kt-scroll-offset="0">

            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold fs-6" 
                 id="kt_aside_menu" 
                 data-kt-menu="true">

                <!-- Dashboard -->
                <div class="menu-item">
                    <a class="menu-link <?= ($this->uri->segment(2) == 'admin_dashboard') ? 'active' : '' ?>" 
                       href="<?= site_url('admin/admin_dashboard') ?>">
                        <span class="menu-icon"><i class="ki-outline ki-element-11 fs-2"></i></span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </div>

                <!-- Người dùng -->
                <div data-kt-menu-trigger="click" 
                     class="menu-item menu-accordion <?= in_array($this->uri->segment(2), ['users', 'add_user']) ? 'show' : '' ?>">
                    <span class="menu-link">
                        <span class="menu-icon"><i class="ki-outline ki-user fs-2"></i></span>
                        <span class="menu-title">Người dùng</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link <?= ($this->uri->segment(2) == 'users') ? 'active' : '' ?>" 
                               href="<?= site_url('admin/users') ?>">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title">Danh sách</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link <?= ($this->uri->segment(2) == 'add_user') ? 'active' : '' ?>" 
                               href="<?= site_url('admin/add_user') ?>">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title">Thêm mới</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tool SEO -->
                <div data-kt-menu-trigger="click" 
                      class="menu-item menu-accordion <?= in_array($this->uri->segment(1), ['seo', 'seo_setting','manualindexcheck']) ? 'show' : '' ?>">
                    <span class="menu-link">
                        <span class="menu-icon"><i class="ki-outline ki-search-list fs-2"></i></span>
                        <span class="menu-title">Tool SEO</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link <?= ($this->uri->segment(2) == 'check_index') ? 'active' : '' ?>" 
                               href="<?= site_url('seo/check_index') ?>">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title">Check Index Google</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link <?= ($this->uri->segment(1) == 'seo_setting') ? 'active' : '' ?>" 
                            href="<?= site_url('seo_setting') ?>">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title">Cấu hình API</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link <?= ($this->uri->segment(1) == 'manualindexcheck') ? 'active' : '' ?>" 
                            href="<?= site_url('manualindexcheck') ?>">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title">Check Index thủ công</span>
                            </a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="<?= site_url('admin/logout') ?>">
                            <span class="menu-icon">
                                <i class="ki-outline ki-exit-left fs-2"></i>
                            </span>
                            <span class="menu-title">Đăng xuất</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--end::Aside menu-->
</div>
<!--end::Aside-->