<?= $this->extend('layouts/layout'); ?>

<?= $this->section('content') ?>
    <style>
        .product-box.vertical-product .product-content {
            width: 100%;
            padding: 16px;
        }
    </style>
<?php
$orderStatusArray = [
    'pending' => 'Onay Bekliyor',
    'preparing' => 'Hazırlanıyor',
    'ready' => 'Hazır',
    'completed' => 'Tamamlandı',
    'cancelled' => 'İptal Edildi'
];
?>

    <header class="main-header">
        <div class="custom-container">
            <div class="header-panel py-3">
                <a onclick="history.back();">
                    <?= getLucideIcon("arrow-left", "icon-btn back-arrow") ?>
                </a>
                <h3>Siparişlerim</h3>
            </div>
        </div>
    </header>

    <section class="order-section section-b-space pt-0">
        <ul class="nav nav-Tabs order-tab custom-scrollbar px-20" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="active-tab" data-bs-toggle="tab" data-bs-target="#active-tab-pane"
                        type="button" role="tab">
                    Aktif
                    <?php if (!empty($activeOrders)): ?>
                        <span class="badge bg-primary ms-1"><?= count($activeOrders) ?></span>
                    <?php endif; ?>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="complete-tab" data-bs-toggle="tab" data-bs-target="#complete-tab-pane"
                        type="button" role="tab">
                    Tamamlanan
                    <?php if (!empty($completedOrders)): ?>
                        <span class="badge bg-success ms-1"><?= count($completedOrders) ?></span>
                    <?php endif; ?>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="cancelled-tab" data-bs-toggle="tab" data-bs-target="#cancelled-tab-pane"
                        type="button" role="tab">
                    İptal Edilen
                    <?php if (!empty($cancelledOrders)): ?>
                        <span class="badge bg-danger ms-1"><?= count($cancelledOrders) ?></span>
                    <?php endif; ?>
                </button>
            </li>
        </ul>

        <div class="custom-container">
            <div class="tab-content" id="myTabContent">
                <!-- Aktif Siparişler -->
                <div class="tab-pane fade show active" id="active-tab-pane" role="tabpanel" tabindex="0">
                    <div class="mt-2 row gy-3 gx-0">
                        <?php if (!empty($activeOrders)): ?>
                            <?php foreach ($activeOrders as $order): ?>
                                <div class="col-12 mb-3">
                                    <div class="product-box vertical-product">
                                        <!--<div class="product-img">
                                            <img src="<?php /*= base_url('public/assets/images/placeholder.jpg') */ ?>"
                                                 class="img-fluid rounded" alt="Sipariş">
                                        </div>-->
                                        <div class="product-content">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h5 class="title-color mb-1">Sipariş
                                                        #<?= $order['order_number'] ?></h5>
                                                    <small class="title-color">
                                                        <?= date('d.m.Y H:i', strtotime($order['created_at'])) ?>
                                                    </small>
                                                </div>
                                                <span class="badge bg-<?= $order['status'] === 'ready' ? 'success' : 'warning' ?>">
                                                    <?= strtoupper($orderStatusArray[$order['status']]) ?>
                                                </span>
                                            </div>

                                            <div class="my-2">
                                                <small class="title-color">
                                                    <?= $order['products'] ?>
                                                </small>
                                            </div>

                                            <div class="bottom-content">
                                                <h5 class="price mb-0"><?= number_format($order['final_amount'], 2) ?>
                                                    ₺</h5>
                                            </div>
                                        </div>
                                        <a href="<?= base_url('order/status/' . $order['id']) ?>"
                                           class="btn btn-sm theme-btn order-btn">
                                            Detayları Gör
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12 text-center py-5">
                                <?= getLucideIcon("package", "w-40 h-40 mx-auto title-color") ?>
                                <h5 class="mt-3">Aktif siparişiniz bulunmamaktadır</h5>
                                <a href="<?= base_url('/') ?>" class="btn btn-primary mt-3">Menüye Gözat</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Tamamlanan Siparişler -->
                <div class="tab-pane fade" id="complete-tab-pane" role="tabpanel" tabindex="0">
                    <div class="row gy-3 gx-0">
                        <?php if (!empty($completedOrders)): ?>
                            <?php foreach ($completedOrders as $order): ?>
                                <div class="col-12 mb-3">
                                    <div class="product-box vertical-product">
                                        <div class="product-img">
                                            <img src="<?= base_url('public/assets/images/placeholder.jpg') ?>"
                                                 class="img-fluid rounded" alt="Sipariş">
                                        </div>
                                        <div class="product-content">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h5 class="title-color mb-1">Sipariş
                                                        #<?= $order['order_number'] ?></h5>
                                                    <small class="title-color">
                                                        <?= date('d.m.Y H:i', strtotime($order['created_at'])) ?>
                                                    </small>
                                                </div>
                                                <span class="badge bg-success">
                                                    Tamamlandı
                                                </span>
                                            </div>

                                            <div class="my-2">
                                                <small class="title-color">
                                                    <?= $order['products'] ?>
                                                </small>
                                            </div>

                                            <div class="bottom-content">
                                                <h5 class="price mb-0">
                                                    <?= number_format($order['final_amount'], 2) ?> ₺
                                                </h5>
                                            </div>
                                        </div>
                                        <a href="<?= base_url('order/status/' . $order['id']) ?>"
                                           class="btn btn-sm theme-btn order-btn">
                                            Detayları Gör
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12 text-center py-5">
                                <?= getLucideIcon("package-check", "w-40 h-40 mx-auto title-color") ?>
                                <h5 class="mt-3">Tamamlanan siparişiniz bulunmamaktadır</h5>
                                <a href="<?= base_url('/') ?>" class="btn btn-primary mt-3">Menüye Gözat</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- İptal Edilen Siparişler -->
                <div class="tab-pane fade" id="cancelled-tab-pane" role="tabpanel" tabindex="0">
                    <div class="row gy-3 gx-0">
                        <?php if (!empty($cancelledOrders)): ?>
                            <?php foreach ($cancelledOrders as $order): ?>
                                <div class="col-12 mb-3">
                                    <div class="product-box vertical-product">
                                        <div class="product-img">
                                            <img src="<?= base_url('public/assets/images/placeholder.jpg') ?>"
                                                 class="img-fluid rounded" alt="Sipariş">
                                        </div>
                                        <div class="product-content">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h5 class="title-color mb-1">Sipariş
                                                        #<?= $order['order_number'] ?></h5>
                                                    <small class="title-color">
                                                        <?= date('d.m.Y H:i', strtotime($order['created_at'])) ?>
                                                    </small>
                                                </div>
                                                <span class="badge bg-danger">
                                        İptal Edildi
                                    </span>
                                            </div>

                                            <div class="my-2">
                                                <small class="title-color">
                                                    <?= $order['products'] ?>
                                                </small>
                                            </div>

                                            <div class="bottom-content">
                                                <h5 class="price mb-0"><?= number_format($order['final_amount'], 2) ?>
                                                    ₺</h5>
                                            </div>
                                        </div>
                                        <a href="<?= base_url('order/status/' . $order['id']) ?>"
                                           class="btn btn-sm theme-btn order-btn">
                                            Detayları Gör
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12 text-center py-5">
                                <?= getLucideIcon("package-x", "w-40 h-40 mx-auto title-color") ?>
                                <h5 class="mt-3">İptal edilen siparişiniz bulunmamaktadır</h5>
                                <a href="<?= base_url('/') ?>" class="btn btn-primary mt-3">Menüye Gözat</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Tab geçişlerini yönet
            const tabElms = document.querySelectorAll('button[data-bs-toggle="tab"]');
            tabElms.forEach(tabElm => {
                tabElm.addEventListener('click', function (event) {
                    const tabTrigger = new bootstrap.Tab(this);
                    tabTrigger.show();

                    const target = this.getAttribute('data-bs-target');
                    if (target) {
                        history.pushState(null, null, target);
                    }
                });
            });

            if (window.location.hash) {
                const tabTrigger = new bootstrap.Tab(document.querySelector(
                    `button[data-bs-target="${window.location.hash}"]`
                ));
                tabTrigger.show();
            }
        });
    </script>

<?= $this->endSection() ?>