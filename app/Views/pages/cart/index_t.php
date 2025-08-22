<?= $this->extend('layouts/layout'); ?>

<?= $this->section('content') ?>

    <header class="main-header">
        <div class="custom-container">
            <div class="header-panel py-3">
                <a onclick="history.back();">
                    <?= getLucideIcon("arrow-left", "icon-btn back-arrow") ?>
                </a>
                <div class="d-flex w-100" style="justify-content: space-between">
                    <h3>
                        Sepetim
                        <?php if (!empty($cartItems['items'])): ?>
                            <span class="content-color"> (<span
                                        class="total-count"><?= $cartItems['totalItems'] ?? 0 ?></span> Ürün) </span>
                        <?php endif; ?>
                    </h3>
                    <?php if (!empty($cartItems['items'])): ?>
                        <a href="#" class="btn btn-sm btn-outline-danger clear-cart-btn"
                           style="font-size: 13px !important;letter-spacing: 1px;">
                            Sepeti Boşalt
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <section class="section-sm-t-space">
        <div class="custom-container">
            <div class="row gy-3 gx-0">
                <?php if (!empty($cartItems['items'])): ?>
                    <?php foreach ($cartItems['items'] as $item): ?>
                        <div class="col-12 product-row" data-cart-item-id="<?= $item['cart_item_id'] ?>"
                             data-product-id="<?= $item['id'] ?>">
                            <div class="product-box vertical-product">
                                <a href="<?= base_url('product/' . $item['id']) ?>" class="product-img">
                                    <img src="<?= !empty($item['image']) ?
                                        'http://localhost/web_kafe_otomasyon/public/backend/assets/images/products/' . $item['image'] :
                                        'http://localhost/web_kafe_otomasyon/public/assets/images/placeholder.jpg' ?>"
                                         class="img-fluid" alt="<?= esc($item['title']) ?>">
                                </a>
                                <div class="product-content">
                                    <h6 class="content-color"><?= esc($item['category_title']) ?></h6>
                                    <a href="<?= base_url('product/' . $item['id']) ?>" class="product-top">
                                        <h5 class="title-color white-nowrap"><?= esc($item['title']) ?></h5>
                                    </a>

                                    <?php if (!empty($item['note'])): ?>
                                        <div class="product-note">
                                            <small class="text-muted"><small><i><?= esc($item['note']) ?></i></small></small>
                                        </div>
                                    <?php endif; ?>

                                    <div class="bottom-content cart-content">
                                        <h5 class="price"><?= number_format($item['price'], 2) ?> ₺</h5>

                                        <div class="plus-minus">
                                            <span onclick="updateQuantity('<?= $item['cart_item_id'] ?>', -1)"
                                                  style="height: 25px">
                                                <?= getLucideIcon("minus", "icon") ?>
                                            </span>
                                            <input type="number" class="quantity-input"
                                                   value="<?= $item['quantity'] ?? 1 ?>" min="1" max="50"
                                                   data-cart-item-id="<?= $item['cart_item_id'] ?>"
                                                   disabled onchange="validateQuantity(this)">
                                            <span onclick="updateQuantity('<?= $item['cart_item_id'] ?>', 1)"
                                                  style="height: 25px">
                                                <?= getLucideIcon("plus", "icon") ?>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <div class="close-icon" onclick="showRemoveModal('<?= $item['cart_item_id'] ?>')">
                                    <?= getLucideIcon("x", "icon") ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center py-5">
                        <?= getLucideIcon("handbag", "w-40 h-40 mx-auto text-muted") ?>
                        <h5 class="mt-3">Sepetiniz boş</h5>
                        <a href="<?= $qrInfo["url"] ?? base_url() ?>" class="btn btn-primary mt-3">Sipariş Oluşturmaya Başla</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php if (!empty($cartItems['items'])): ?>
    <section class="mt-4">
        <div class="custom-container">
            <div class="title mb-2">
                <h3>Fiyat Detayları</h3>
            </div>
            <div class="bill-box">
                <div class="bill-box-content">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="fw-medium content-color">Toplam (<span
                                    class="total-count"><?= $cartItems['totalItems'] ?? 0 ?></span> Ürün)</h5>
                        <h4 class="fw-medium theme-color total-price"><?= number_format($cartItems['totalPrice'] ?? 0, 2) ?>
                            ₺</h4>
                    </div>
                    <div class="d-flex align-items-center justify-content-between pt-2">
                        <h5 class="fw-medium content-color">İndirim</h5>
                        <h5 class="fw-medium title-color"><?= number_format($discount ?? 0, 2) ?> ₺</h5>
                    </div>

                    <div class="total-amount">
                        <h5 class="fw-medium title-color">Genel Toplam</h5>
                        <h4 class="fw-medium theme-color total-price"><?= number_format($cartItems['totalPrice'] - $discount, 2) ?>
                            ₺</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="custom-container mt-4 mb-5">
        <button type="button" id="createOrderBtn" class="btn theme-btn w-100">Siparişi Oluştur</button>
    </div>

    <div class="secure-payment-wrapper mt-24 mb-25" style="padding-bottom: 120px">
        <img class="img-fluid" src="<?= base_url('public/assets/images/svg/secure.svg') ?>" alt="secure">
        <p>Güvenli ödeme. %100 Orijinal Lezzetli Tatlar.</p>
    </div>
<?php endif; ?>

    <!-- Ürün Silme Onay Modalı -->
    <div class="modal fade" id="removeItemModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ürünü Kaldır</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body content-color">
                    <h6>Bu ürünü sepetinizden çıkarmak istediğinize emin misiniz?</h6>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger" id="confirmRemoveBtn">Kaldır</button>
                    <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal">Vazgeç</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sepet Boşaltma Onay Modalı -->
    <div class="modal fade" id="confirmClearModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sepeti Boşalt</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body content-color">
                    <h6>Sepetinizi boşaltmak istediğinize emin misiniz?</h6>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger" id="confirmClearBtn">Sepeti Boşalt</button>
                    <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal">Vazgeç</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sonuç Modalı -->
    <div class="modal fade" id="resultModalCart" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-4">
                    <?= getLucideIcon("check-circle", "w-40 h-40 mb-3 text-success") ?>
                    <h5 class="mb-3" id="resultMessage">İşlem Başarılı</h5>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tamam</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sipariş oluşturma butonu
        document.getElementById('createOrderBtn')?.addEventListener('click', function () {
            createOrder();
        });

        function createOrder() {
            const btn = document.getElementById('createOrderBtn');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Oluşturuluyor...';

            fetch('<?= base_url('order/create') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '<?= csrf_token() ?>'
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('HTTP error: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Başarılı mesajı göster
                        showResultModal('Siparişiniz başarıyla oluşturuldu! Sipariş numaranız: ' + data.order_number, true);

                        // Sepeti temizle ve yönlendir
                        setTimeout(() => {
                            window.location.href = '<?= base_url('order/status/') ?>' + data.order_id;
                        }, 2000);

                    } else {
                        showResultModal(data.message || 'Sipariş oluşturulamadı', false);
                        btn.disabled = false;
                        btn.innerHTML = 'Siparişi Oluştur';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showResultModal('İşlem sırasında hata oluştu: ' + error.message, false);
                    btn.disabled = false;
                    btn.innerHTML = 'Siparişi Oluştur';
                });
        }

        let currentCartItemId = null;
        const removeItemModal = new bootstrap.Modal(document.getElementById('removeItemModal'));
        const confirmClearModal = new bootstrap.Modal(document.getElementById('confirmClearModal'));
        const resultModal = new bootstrap.Modal(document.getElementById('resultModalCart'));

        // Ürün silme modalını göster
        function showRemoveModal(cartItemId) {
            currentCartItemId = cartItemId;
            removeItemModal.show();
        }

        // MODAL ONAY BUTONU TETİKLENDİĞİNDE ÇALIŞACAK TEK SİLME FONKSİYONU
        function confirmRemoveItem() {
            if (!currentCartItemId) return;

            fetch('<?= base_url('cart/remove') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '<?= csrf_token() ?>'
                },
                body: JSON.stringify({
                    cart_item_id: currentCartItemId
                })
            })
                .then(response => {
                    if (!response.ok) throw new Error('HTTP error: ' + response.status);
                    return response.json();
                })
                .then(data => {
                    removeItemModal.hide();

                    if (data.success) {
                        const productRow = document.querySelector(`.product-row[data-cart-item-id="${currentCartItemId}"]`);
                        if (productRow) {
                            productRow.remove();
                        }

                        var totalPrice = 0;
                        if (data.data.totalPrice) {
                            totalPrice = typeof data.data.totalPrice === 'string' ?
                                parseFloat(data.data.totalPrice.replace(/,/g, '')) :
                                parseFloat(data.data.totalPrice);
                        }

                        // Tüm .total-price elementlerini seç ve her birini güncelle
                        document.querySelectorAll('.total-price').forEach(element => {
                            element.textContent = parseFloat(totalPrice).toFixed(2) + ' ₺';
                        });

                        updateCartCounters(data.data.cartCount);

                        // Sepet boşsa sayfayı yenile
                        if (data.data.cartCount === 0) {
                            location.reload();
                        }
                    } else {
                        showResultModal(data.message || 'Ürün kaldırılamadı', false);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showResultModal('İşlem sırasında hata oluştu: ' + error.message, false);
                });
        }

        // Miktar güncelleme fonksiyonu (EKSİ BUTONU SADECE MİKTAR AZALTIR)
        function updateQuantity(cartItemId, change) {
            const input = document.querySelector(`.quantity-input[data-cart-item-id="${cartItemId}"]`);
            let newValue = parseInt(input.value) + change;
            newValue = Math.max(1, Math.min(50, newValue));

            if (newValue !== parseInt(input.value)) {
                input.value = newValue;
                updateCartItem(cartItemId, newValue);
            }
        }

        // Sepet güncelleme fonksiyonu
        function updateCartItem(cartItemId, quantity) {
            fetch('<?= base_url('cart/update') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '<?= csrf_token() ?>'
                },
                body: JSON.stringify({
                    cart_item_id: cartItemId,
                    quantity: quantity
                })
            })
                .then(handleResponse)
                .then(data => {
                    if (data.success) {

                        var totalPrice = 0;
                        if (data.data.totalPrice) {
                            totalPrice = typeof data.data.totalPrice === 'string' ?
                                parseFloat(data.data.totalPrice.replace(/,/g, '')) :
                                parseFloat(data.data.totalPrice);
                        }

                        // Tüm .total-price elementlerini seç ve her birini güncelle
                        document.querySelectorAll('.total-price').forEach(element => {
                            element.textContent = parseFloat(totalPrice).toFixed(2) + ' ₺';
                        });

                        updateCartCounters(data.data.cartCount);
                    }
                })
                .catch(handleError);
        }

        // Yardımcı fonksiyonlar
        function handleResponse(response) {
            if (!response.ok) throw new Error('HTTP error: ' + response.status);
            return response.json();
        }

        function handleError(error) {
            console.error('Error:', error);
            showResultModal('İşlem sırasında hata oluştu: ' + error.message, false);
        }

        function updateCartCounters(count) {
            document.querySelectorAll('.cart-count, .total-count, .content-color span').forEach(el => {
                el.textContent = count;
            });
        }

        function showResultModal(message, isSuccess) {
            const icon = document.querySelector('#resultModalCart [data-icon]');
            icon.className = isSuccess ? 'w-40 h-40 mb-3 text-success' : 'w-40 h-40 mb-3 text-danger';
            icon.setAttribute('data-icon', isSuccess ? 'check-circle' : 'x-circle');

            document.getElementById('resultMessage').textContent = message;
            resultModal.show();
        }

        // Event listener'lar
        document.addEventListener('DOMContentLoaded', function () {
            // Silme onay butonu
            document.getElementById('confirmRemoveBtn').addEventListener('click', confirmRemoveItem);

            // Sepet boşaltma butonu
            document.querySelector('.clear-cart-btn')?.addEventListener('click', function (e) {
                e.preventDefault();
                confirmClearModal.show();
            });

            // Sepet boşaltma onayı
            document.getElementById('confirmClearBtn').addEventListener('click', function () {
                fetch('<?= base_url('cart/clear') ?>', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '<?= csrf_token() ?>',
                        'Accept': 'application/json'
                    }
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            showNotification("success", '<?= getLucideIcon("check-circle", "text-success") ?>', "Başarılı", data.message || 'Sepetiniz boşaltıldı', 3);
                            updateCartView();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification("error", '<?= getLucideIcon("x-circle", "text-danger") ?>', "Hata", " Bir hata oluştu: " + error.message, 3);
                    });
            });

            // Sepet görünümünü güncelleyen fonksiyon
            function updateCartView() {
                // Sepet ürünlerini içeren container'ı seç
                var cartContainer = document.querySelector('.row.gy-3.gx-0');

                // Sepet boş görünümünü oluştur
                var emptyCartHTML = `
                    <div class="col-12 text-center py-5">
                        <?= getLucideIcon("handbag", "w-40 h-40 mx-auto text-muted") ?>
                        <h5 class="mt-3">Sepetiniz boş</h5>
                        <a href="<?= $qrInfo["url"] ?? base_url() ?>" class="btn btn-primary mt-3">Sipariş Oluşturmaya Başla</a>
                    </div>
                `;

                // Ürün listesini boş görünümle değiştir
                cartContainer.innerHTML = emptyCartHTML;

                // Fiyat detayları ve ödeme butonunu gizle
                document.querySelector('section.mt-4')?.remove();
                document.querySelector('.custom-container.mt-4.mb-5')?.remove();
                document.querySelector('.secure-payment-wrapper')?.remove();

                // Sepet sayacını sıfırla
                updateCartCounters(0);

                // Başlıktaki ürün sayısını kaldır
                const title = document.querySelector('.header-panel h3');
                if (title) {
                    title.innerHTML = 'Sepetim';
                }

                // Sepeti boşalt butonunu gizle
                document.querySelector('.clear-cart-btn')?.remove();

                confirmClearModal.hide();
            }
        });
    </script>
<?= $this->endSection() ?>