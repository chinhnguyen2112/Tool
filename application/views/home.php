<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>Đăng nhập / Đăng ký</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow-sm">
        <div class="card-body">
          <h4 class="text-center mb-3">Trang người dùng</h4>

          <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
          <?php endif; ?>

          <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
          <?php endif; ?>

          <ul class="nav nav-tabs mb-3">
            <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#login">Đăng nhập</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#register">Đăng ký</button></li>
          </ul>

          <div class="tab-content">
            <div class="tab-pane fade show active" id="login">
              <form method="post" action="<?= site_url('home/login') ?>">
                <div class="mb-3">
                  <label class="form-label">Tên đăng nhập</label>
                  <input type="text" class="form-control" name="username" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Mật khẩu</label>
                  <input type="password" class="form-control" name="password" required>
                </div>
                <button class="btn btn-primary w-100">Đăng nhập</button>
              </form>
            </div>

            <div class="tab-pane fade" id="register">
              <form method="post" action="<?= site_url('home/register') ?>">
                <div class="mb-3">
                  <label class="form-label">Tên đăng nhập</label>
                  <input type="text" class="form-control" name="username" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Mật khẩu</label>
                  <input type="password" class="form-control" name="password" required>
                </div>
                <button class="btn btn-success w-100">Đăng ký</button>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
