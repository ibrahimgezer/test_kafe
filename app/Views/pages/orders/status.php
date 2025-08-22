<?= $this->extend('layouts/layout'); ?>

<?= $this->section('content') ?>
    <style>
        .order-timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 20px;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        .timeline-item:before {
            content: '';
            position: absolute;
            left: -20px;
            top: 0;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #ddd;
            border: 3px solid #fff;
        }

        .timeline-item:after {
            content: '';
            position: absolute;
            left: -15px;
            top: 12px;
            width: 2px;
            height: 100%;
            background: #ddd;
        }

        .timeline-item:last-child:after {
            display: none;
        }

        .timeline-item.active:after {
            opacity: 0.3;
        }

        .title-header {
            padding-top: 5px;
            border-bottom: 1px solid rgba(var(--title-color), .5) !important;
            width: 100%;
            padding-bottom: 10px;
        }
    </style>


    <header class="main-header">
        <div class="custom-container">
            <div class="header-panel py-3">
                <a onclick="history.back();">
                    <?= getLucideIcon("arrow-left", "icon-btn back-arrow") ?>
                </a>
                <h3>Sipariş Detayı</h3>
            </div>
        </div>
    </header>

    <section class="section-sm-t-space">
        <div class="custom-container" style="padding-bottom: 100px">
            <!-- Sipariş Özeti -->
            <div class="product-box vertical-product mb-3">
                <div class="product-content p-3" style="width: 100%">
                    <div class="d-flex justify-content-between align-items-start mb-3">
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

                    <div class="d-flex justify-content-between mb-2">
                        <small class="title-color">Toplam Ürün:</small>
                        <small class="title-color"><?= count($order['items']) ?> Adet</small>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <small class="title-color">Ara Toplam:</small>
                        <small class="title-color"><?= number_format($order['total_amount'], 2) ?> ₺</small>
                    </div>

                    <?php if ($order['discount'] > 0): ?>
                        <div class="d-flex justify-content-between mb-2">
                            <small class="title-color">İndirim:</small>
                            <small class="text-danger">-<?= number_format($order['discount'], 2) ?> ₺</small>
                        </div>
                    <?php endif; ?>

                    <div class="d-flex justify-content-between fw-bold">
                        <span class="title-color">Genel Toplam:</span>
                        <span class="theme-color"><?= number_format($order['final_amount'], 2) ?> ₺</span>
                    </div>
                </div>
            </div>

            <!-- Sipariş Durum Takibi -->
            <div class="product-box vertical-product mb-3">
                <div class="product-content p-3" style="width: 100%">
                    <h5 class="title-color mb-1 title-header">Sipariş Durumu</h5>
                    <div class="order-timeline py-3">
                        <?php
                        $statuses = [
                            'pending' => 'Sipariş Alındı',
                            'preparing' => 'Hazırlanıyor',
                            'ready' => 'Hazır',
                            'completed' => 'Teslim Edildi'
                        ];

                        $currentStatus = $order['status'];
                        foreach ($statuses as $status => $label):
                            $isActive = array_search($status, array_keys($statuses)) <= array_search($currentStatus, array_keys($statuses));
                            $isCurrent = $status === $currentStatus;
                            ?>
                            <div class="timeline-item <?= $isActive ? 'active' : '' ?>">
                                <h6 class="<?= $isActive ? 'theme-color' : 'title-color' ?>">
                                    <?= $label ?>
                                    <?php if ($isCurrent): ?>
                                        <small class="title-color">(Devam Ediyor)</small>
                                    <?php endif; ?>
                                </h6>
                                <?php if ($history = array_filter($order['status_history'], fn($h) => $h['status'] == $status)): ?>
                                    <?php $lastHistory = end($history); ?>
                                    <small class="title-color">
                                        <?= date('d.m.Y H:i', strtotime($lastHistory['created_at'])) ?>
                                    </small>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Sipariş Öğeleri -->
            <div class="product-box vertical-product mb-3">
                <div class="product-content p-3" style="width: 100%">
                    <h5 class="title-color mb-3 title-header">Sipariş İçeriği</h5>
                    <div class="row gy-2">
                        <?php foreach ($order['items'] as $item): ?>
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="title-color"><?= $item['product_name'] ?></h6>
                                        <small class="title-color"><?= $item['quantity'] ?>
                                            x <?= number_format($item['unit_price'], 2) ?> ₺</small>
                                        <?php if (!empty($item['note'])): ?>
                                            <div class="mt-1">
                                                <small class="title-color"><i><?= $item['note'] ?></i></small>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <h6 class="title-color"><?= number_format($item['total_price'], 2) ?> ₺</h6>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Ödeme Bilgileri -->
            <?php if ($order['status'] !== 'completed' && $order['status'] !== 'cancelled'): ?>
                <div class="product-box vertical-product mb-3">
                    <div class="product-content p-3" style="width: 100%">
                        <h5 class="title-color mb-3 title-header">Ödeme</h5>
                        <form id="paymentForm" action="<?= base_url('order/payment/' . $order['id']) ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="mb-3">
                                <label class="form-label title-color">Ödeme Yöntemi</label>
                                <select class="form-select" name="payment_method" required>
                                    <option value="">Lütfen Seçiniz</option>
                                    <?php foreach ($paymentMethods as $value => $label): ?>
                                        <option value="<?= $value ?>"><?= $label ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div id="creditCardFields" class="mb-2" style="display:none;">
                                <div class="mb-3">
                                    <label class="form-label title-color">Kart Numarası</label>
                                    <input type="text" class="form-control" name="card_number"
                                           placeholder="1234 5678 9012 3456">
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label title-color">Son Kullanma</label>
                                        <input type="text" class="form-control" name="card_expiry" placeholder="MM/YY">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label title-color">CVV</label>
                                        <input type="text" class="form-control" name="card_cvv" placeholder="123">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn theme-btn w-100 mt-1 mb-2">
                                <?= number_format($order['final_amount'], 2) ?> ₺ ÖDEME YAP
                            </button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Ödeme yöntemine göre alanları göster/gizle
            const paymentMethod = document.querySelector('select[name="payment_method"]');
            const creditCardFields = document.getElementById('creditCardFields');

            paymentMethod.addEventListener('change', function () {
                if (this.value === 'credit_card') {
                    creditCardFields.style.display = 'block';
                } else {
                    creditCardFields.style.display = 'none';
                }
            });

            // Ödeme formu gönderimi
            const paymentForm = document.getElementById('paymentForm');
            if (paymentForm) {
                paymentForm.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;

                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span> İşleniyor...';

                    fetch(this.action, {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                showToast('success', data.message);
                                setTimeout(() => {
                                    window.location.reload();
                                }, 2000);
                            } else {
                                showToast('error', data.message);
                                submitBtn.disabled = false;
                                submitBtn.innerHTML = originalText;
                            }
                        })
                        .catch(error => {
                            showToast('error', 'Bir hata oluştu');
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = originalText;
                        });
                });
            }

            function showToast(type, message) {
                // Toast mesajı gösterimi burada yapılabilir
                alert(message); // Basit bir uyarı olarak gösteriyoruz
            }
        });
    </script>

<?= $this->endSection() ?>