<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid">
            <div class="container-xxl">
                <div class="card shadow-sm border-0">
                    <div class="card-header">
                        <h3 class="card-title">Thêm người dùng</h3>
                    </div>

                    <form method="post" class="form">
                        <div class="card-body py-5">
                            <div class="mb-5">
                                <label class="form-label fw-semibold">Tên đăng nhập</label>
                                <input type="text" name="username" class="form-control form-control-solid" required>
                            </div>

                            <div class="mb-5">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control form-control-solid" required>
                            </div>

                            <div class="mb-5">
                                <label class="form-label fw-semibold">Mật khẩu</label>
                                <input type="password" name="password" class="form-control form-control-solid" required>
                            </div>

                            <div class="mb-5">
                                <label class="form-label fw-semibold">Vai trò</label>
                                <select name="role" class="form-select form-select-solid" required>
                                    <option value="user">Người dùng</option>
                                    <option value="admin">Quản trị</option>
                                </select>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-end">
                            <a href="<?= site_url('admin/users') ?>" class="btn btn-light me-3">Hủy</a>
                            <button type="submit" class="btn btn-primary">Lưu người dùng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
