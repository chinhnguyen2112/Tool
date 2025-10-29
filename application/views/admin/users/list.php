<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid">
        <div class="container-xxl">

            <div class="card shadow-sm border-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Danh sách người dùng</h3>
                    <a href="<?= site_url('admin/add_user') ?>" class="btn btn-primary btn-sm">
                        <i class="ki-outline ki-plus fs-3"></i> Thêm người dùng
                    </a>
                </div>

                <div class="card-body">
                    <table class="table table-striped align-middle" id="kt_table_users">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên đăng nhập</th>
                                <th>Email</th>
                                <th>Vai trò</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $user['id'] ?></td>
                                <td><?= $user['username'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td>
                                    <span class="badge badge-light-<?= $user['role']=='admin'?'danger':'success' ?>">
                                        <?= ucfirst($user['role']) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?= site_url('admin/edit_user/'.$user['id']) ?>" class="btn btn-sm btn-warning">Sửa</a>
                                    <a href="<?= site_url('admin/delete_user/'.$user['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xóa người dùng này?')">Xóa</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
