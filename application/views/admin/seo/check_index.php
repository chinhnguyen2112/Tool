<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid">
        <div class="container-xxl">

            <div class="card shadow-sm border-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Tool Check Index SEO</h3>
                </div>

                <div class="card-body">
                    <form method="post" action="<?= site_url('seo/check_index') ?>">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Danh sách URL (mỗi dòng 1 link)</label>
                            <textarea name="urls" rows="6" class="form-control" placeholder="https://example.com/page1
https://example.com/page2"><?= set_value('urls') ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="ki-outline ki-search-list fs-4"></i> Kiểm tra
                        </button>
                    </form>
                </div>

                <?php if (!empty($results)): ?>
                <div class="card-body border-top mt-5 bg-light">
                    <h4 class="fw-bold mb-4">Kết quả kiểm tra</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="fw-bold">URL</th>
                                    <th class="fw-bold">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($results as $r): ?>
                                <tr>
                                    <td><?= htmlspecialchars($r['url']) ?></td>
                                    <td>
                                        <span class="badge <?= $r['status']=='Indexed' ? 'badge-success' : 'badge-danger' ?>">
                                            <?= $r['status'] ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <form method="post" action="<?= site_url('seo/export_excel') ?>">
                            <?php foreach ($results as $r): ?>
                                <input type="hidden" name="urls[]" value="<?= htmlspecialchars($r['url']) ?>">
                                <input type="hidden" name="status[]" value="<?= $r['status'] ?>">
                            <?php endforeach; ?>
                            <button type="submit" class="btn btn-success">
                                <i class="ki-outline ki-file-excel fs-4"></i> Xuất Excel
                            </button>
                        </form>
                    </div>

                </div>
                <?php endif; ?>

            </div>

        </div>
    </div>
</div>
</div>
