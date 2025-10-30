<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid">
            <div class="container-xxl">

                <div class="card shadow-sm border-0">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Cấu hình Google CSE API</h3>
                    </div>

                    <div class="card-body">
                        <?php if(!empty($success)): ?>
                            <div class="alert alert-success"><?= $success ?></div>
                        <?php endif; ?>

                        <form method="post" action="<?= site_url('seo_setting/save') ?>" class="row g-3 align-items-center">
                            <div class="col-md-5">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($edit_key['id'] ?? '') ?>">
                                <input type="text" name="cse_id" class="form-control" placeholder="Nhập CSE ID" value="<?= htmlspecialchars($edit_key['cse_id'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="api_key" class="form-control" placeholder="Nhập API Key" value="<?= htmlspecialchars($edit_key['api_key'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-2 d-grid">
                                <button type="submit" class="btn btn-success">
                                    <i class="ki-outline ki-save fs-5"></i> <?= isset($edit_key) ? 'Cập nhật' : 'Thêm mới' ?>
                                </button>
                            </div>
                        </form>
                    </div>

                    <?php if(!empty($all_keys)): ?>
                    <div class="card-body border-top mt-5 bg-light">
                        <h4 class="fw-bold mb-4">Danh sách CSE ID & API Key</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>CSE ID</th>
                                        <th>API Key</th>
                                        <th>Ngày tạo / Cập nhật</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($all_keys as $i => $key): ?>
                                    <tr>
                                        <td><?= $i+1 ?></td>
                                        <td><?= htmlspecialchars($key['cse_id']) ?></td>
                                        <td><?= htmlspecialchars($key['api_key']) ?></td>
                                        <td><?= htmlspecialchars($key['updated_at'] ?? $key['created_at']) ?></td>
                                        <td>
                                           <a href="<?= site_url('seo_setting/edit/'.$key['id']) ?>" class="btn btn-sm btn-warning">
                                                <i class="ki-outline ki-edit fs-5"></i> Sửa
                                            </a>
                                            <a href="<?= site_url('seo_setting/delete/'.$key['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">
                                                <i class="ki-outline ki-trash fs-5"></i> Xóa
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>

            </div>
        </div>
    </div>
</div>
