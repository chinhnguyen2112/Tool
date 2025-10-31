<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid">
            <div class="container-xxl">

                <div class="card shadow-sm border-0">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title fw-bold">Check Index Google</h3>
                        <div class="card-toolbar">
                            <span class="badge badge-light-primary fw-bold me-2" id="totalUrls">0</span>
                            <span class="badge badge-light-success fw-bold me-2" id="indexedCount">0</span>
                            <span class="badge badge-light-danger fw-bold" id="notIndexedCount">0</span>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="post" action="<?= site_url('manualindexcheck') ?>" class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Nhập danh sách URL (mỗi URL 1 dòng)</label>
                                <textarea name="urls" class="form-control" rows="8" placeholder="https://example.com/page1&#10;https://example.com/page2"><?= set_value('urls') ?></textarea>
                                <div class="form-text">Hỗ trợ HTTP/HTTPS, tự động loại bỏ trùng lặp. %20 và ? sẽ được chuyển thành dấu cách.</div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <button type="submit" class="btn btn-success btn-active-color-primary">
                                    Kiểm tra Index
                                </button>
                            </div>
                        </form>
                    </div>

                    <?php if (!empty($urls)): ?>
                    <div class="card-body border-top pt-6 bg-light-subtle">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="fw-bold mb-0">Kết quả kiểm tra</h4>
                            <div>
                                <span class="fs-7 text-muted me-3">Xử lý: <strong>1 URL/lần</strong></span>
                                <div class="spinner-border spinner-border-sm text-primary d-none" id="processingSpinner" role="status">
                                    <span class="visually-hidden">Đang xử lý...</span>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle table-rounded border gy-3 gs-3" id="resultTable">
                                <thead class="bg-light">
                                    <tr class="fw-bold text-muted text-uppercase fs-7">
                                        <th class="min-w-50px">#</th>
                                        <th class="min-w-300px">URL</th>
                                        <th class="min-w-120px text-center">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                <?php 
                                $i = 1; 
                                $uniqueKeys = [];
                                $urlMap = [];
                                foreach ($urls as $index => $item):
                                    $original = $item['original'];
                                    $key = $item['key'];

                                    if (!in_array($key, $uniqueKeys)) {
                                        $uniqueKeys[] = $key;
                                    }
                                    $urlMap[$key][] = $index;
                                ?>
                                    <tr data-url-key="<?= htmlspecialchars($key) ?>" data-url="<?= htmlspecialchars($original) ?>">
                                        <td><?= $i++ ?></td>
                                        <td class="text-break">
                                            <a href="<?= htmlspecialchars($original) ?>" target="_blank" class="text-primary-hover">
                                                <?= htmlspecialchars($original) ?>
                                            </a>
                                        </td>
                                        <td class="text-center status">
                                            <span class="badge badge-light fw-bold px-3 py-2">Đang chờ...</span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="text-center mt-4">
                            <button id="retryFailed" class="btn btn-sm btn-light-danger d-none">
                                Thử lại các URL thất bại
                            </button>
                        </div>
                    </div>

                    <!-- Script: Xử lý từng URL một -->
                    <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const uniqueKeys = <?= json_encode($uniqueKeys) ?>;
                        const urlMap     = <?= json_encode($urlMap) ?>;
                        const results    = {};
                        const processed  = new Set();
                        let currentKey   = null;

                        const spinner    = document.getElementById('processingSpinner');
                        const retryBtn   = document.getElementById('retryFailed');
                        const totalBadge = document.getElementById('totalUrls');
                        const indexedBadge    = document.getElementById('indexedCount');
                        const notIndexedBadge = document.getElementById('notIndexedCount');

                        totalBadge.textContent = uniqueKeys.length;

                        function updateStats() {
                            const indexed = Object.values(results).filter(r => r.includes('Đã index')).length;
                            const notIndexed = Object.values(results).filter(r => r.includes('Chưa index') || r.includes('Bị chặn') || r.includes('Timeout')).length;
                            indexedBadge.textContent = indexed;
                            notIndexedBadge.textContent = notIndexed;
                        }

                        function updateRowStatus(key, status) {
                            if (results[key] === status) return;
                            results[key] = status;

                            document.querySelectorAll(`tr[data-url-key="${key}"] .status`).forEach(cell => {
                                const b = cell.querySelector('.badge');
                                b.className = 'badge fw-bold px-3 py-2';
                                if (status.includes('Đã index')) {
                                    b.classList.add('badge-success');
                                    b.innerHTML = 'Đã index';
                                } else if (status.includes('Chưa index')) {
                                    b.classList.add('badge-danger');
                                    b.innerHTML = 'Chưa index';
                                } else if (status.includes('Bị chặn')) {
                                    b.classList.add('badge-warning');
                                    b.innerHTML = 'Bị chặn';
                                } else {
                                    b.classList.add('badge-secondary');
                                    b.textContent = status;
                                }
                            });
                            updateStats();
                        }

                        function openNextUrl() {
                            const pending = uniqueKeys.filter(k => !processed.has(k));
                            if (pending.length === 0) {
                                spinner.classList.add('d-none');
                                showRetryButton();
                                return;
                            }

                            currentKey = pending[0];
                            spinner.classList.remove('d-none');
                            
                            window.postMessage({
                                type: "check_index",
                                url: currentKey
                            }, "*");
                        }

                        window.addEventListener('message', function (e) {
                            if (!e.data || e.data.type !== 'index_result') return;

                            const rawKey = e.data.url.replace(/^https?:\/\//i, '').toLowerCase();
                            const key = rawKey.replace(/\/+$/, '');

                            if (uniqueKeys.includes(key)) {
                                updateRowStatus(key, e.data.status);
                                processed.add(key);
                                setTimeout(openNextUrl, 1500); // Đợi 1.5s rồi mở tiếp
                            }
                        });

                        openNextUrl();

                        function showRetryButton() {
                            const failed = uniqueKeys.filter(k => !results[k]);
                            if (failed.length > 0) {
                                retryBtn.classList.remove('d-none');
                                retryBtn.onclick = () => {
                                    retryBtn.classList.add('d-none');
                                    processed.clear();
                                    Object.keys(results).forEach(k => delete results[k]);
                                    document.querySelectorAll('.status .badge').forEach(b => {
                                        b.className = 'badge badge-light fw-bold px-3 py-2';
                                        b.textContent = 'Đang chờ...';
                                    });
                                    indexedBadge.textContent = 0;
                                    notIndexedBadge.textContent = 0;
                                    openNextUrl();
                                };
                            }
                        }
                    });
                    </script>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
</div>