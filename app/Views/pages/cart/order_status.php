<?= $this->extend('layouts/layout'); ?>

<?= $this->section('content') ?>

    <header class="main-header">
        <div class="custom-container">
            <div class="header-panel py-3">
                <a href="<?= base_url() ?>">
                    <?= getLucideIcon("arrow-left", "icon-btn back-arrow") ?>
                </a>
                <h3>Sipariş Durumu</h3>
            </div>
        </div>
    </header>

    <section class="section-sm-t-space">
        <div class="custom-container">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Sipariş #<?= $order['order_number'] ?></h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Durum:</span>
                        <span class="badge bg-<?=
                        $order['status'] == 'pending' ? 'warning' :
                            ($order['status'] == 'preparing' ? 'info' :
                                ($order['status'] == 'ready' ? 'success' : 'secondary'))
                        ?>">
                            <?= ucfirst($order['status']) ?>
                        </span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Tarih:</span>
                        <span><?= date('d.m.Y H:i', strtotime($order['created_at'])) ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Toplam:</span>
                        <span class="fw-bold"><?= number_format($order['final_amount'], 2) ?> ₺</span>
                    </div>
                </div>
            </div>

            <h5 class="mb-3">Sipariş Öğeleri</h5>
            <div class="list-group mb-4">
                <?php foreach ($order['items'] as $item): ?>
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <span><?= $item['product_name'] ?> x <?= $item['quantity'] ?></span>
                            <span><?= number_format($item['total_price'], 2) ?> ₺</span>
                        </div>
                        <?php if (!empty($item['note'])): ?>
                            <small class="text-muted">Not: <?= $item['note'] ?></small>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <h5 class="mb-3">Sipariş Durum Geçmişi</h5>
            <div class="timeline">
                <?php foreach ($order['status_history'] as $history): ?>
                    <div class="timeline-item">
                        <div class="timeline-point"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1"><?= ucfirst($history['status']) ?></h6>
                            <p class="text-muted small mb-1"><?= date('d.m.Y H:i', strtotime($history['created_at'])) ?></p>
                            <?php if (!empty($history['notes'])): ?>
                                <p class="small"><?= $history['notes'] ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <script>

        function checkOrderStatus() {
            fetch('<?= base_url('order/status/' . $order['id']) ?>', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(response => response.json()).then(data => {
                if (data.success && data.status !== '<?= $order['status'] ?>') {
                    window.location.reload();
                }
            });
        }

        setInterval(checkOrderStatus, 30000);
    </script>

<?= $this->endSection() ?>