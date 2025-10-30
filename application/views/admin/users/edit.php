<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid">
        <div class="container-xxl">
            <div class="card shadow-sm border-0">
                <div class="card-header">
                    <h3 class="card-title">Chỉnh sửa người dùng</h3>
                </div>

                <form method="post" class="form">
                    <div class="card-body py-5">
                        <div class="mb-5">
                            <label class="form-label fw-semibold">Tên đăng nhập</label>
                            <input type="text" name="username" value="<?= $user['username'] ?>" class="form-control form-control-solid" required>
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" value="<?= $user['email'] ?>" class="form-control form-control-solid" required>
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-semibold">Mật khẩu (để trống nếu không đổi)</label>
                            <input type="password" name="password" class="form-control form-control-solid" placeholder="••••••••">
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-semibold">Vai trò</label>
                            <select name="role" class="form-select form-select-solid" required>
                                <option value="user" <?= $user['role']=='user'?'selected':'' ?>>Người dùng</option>
                                <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Quản trị</option>
                            </select>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <a href="<?= site_url('admin/users') ?>" class="btn btn-light me-3">Hủy</a>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
