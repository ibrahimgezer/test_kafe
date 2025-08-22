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
<?php else: ?>
    <div class="col-12 text-center py-5">
        <?= getLucideIcon("handbag", "w-40 h-40 mx-auto text-muted") ?>
        <h5 class="mt-3">Sepetiniz boş</h5>
        <a href="<?= $qrInfo["url"] ?? base_url() ?>" class="btn btn-primary mt-3">Sipariş Oluşturmaya Başla</a>
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
        // Global değişkenler
        let removeItemModal, confirmClearModal, resultModal, currentCartItemId;

        // DOM yüklendiğinde çalışacak fonksiyon
        document.addEventListener('DOMContentLoaded', function () {
            // Modaları başlat
            initModals();

            // Event listener'ları ayarla
            setupEventListeners();
        });

        // Modal başlatma fonksiyonu
        function initModals() {
            if (document.getElementById('removeItemModal')) {
                removeItemModal = new bootstrap.Modal(document.getElementById('removeItemModal'));
            }
            if (document.getElementById('confirmClearModal')) {
                confirmClearModal = new bootstrap.Modal(document.getElementById('confirmClearModal'));
            }
            if (document.getElementById('resultModalCart')) {
                resultModal = new bootstrap.Modal(document.getElementById('resultModalCart'));
            }
        }

        // Event listener'ları ayarlama
        function setupEventListeners() {
            // Sipariş oluşturma butonu
            document.getElementById('createOrderBtn')?.addEventListener('click', createOrder);

            // Silme onay butonu
            document.getElementById('confirmRemoveBtn')?.addEventListener('click', confirmRemoveItem);

            // Sepet boşaltma butonu
            document.querySelector('.clear-cart-btn')?.addEventListener('click', function (e) {
                e.preventDefault();
                confirmClearModal?.show();
            });

            // Sepet boşaltma onayı
            document.getElementById('confirmClearBtn')?.addEventListener('click', clearCart);
        }

        // Sipariş oluşturma fonksiyonu
        function createOrder() {
            const btn = $('#createOrderBtn');
            if (!btn.length) return;

            // Buton durumunu güncelle
            btn.prop('disabled', true);
            const originalText = btn.html();
            btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Oluşturuluyor...');

            // CSRF token'ını al
            const csrfToken = $('meta[name="csrf-token"]').attr('content') || '<?= csrf_token() ?>';

            // $.post ile istek gönder
            $.post('<?= base_url('order/create') ?>', {
                // Gönderilecek ek veriler varsa buraya ekleyin
                _token: csrfToken
            })
                .done(function (data) {
                    if (data.success) {
                        // Başarılı mesajını göster
                        showResultModal(
                            'Siparişiniz başarıyla oluşturuldu! Sipariş numaranız: ' + (data.order_number || 'N/A'),
                            true
                        );

                        // 2 saniye sonra yönlendir
                        setTimeout(() => {
                            if (data.order_id) {
                                window.location.href = '<?= base_url('siparislerim') ?>';
                            } /*else {
                                window.location.href = '<?= base_url('order/history') ?>';
                            }*/
                        }, 2000);
                    } else {
                        throw new Error(data.message || 'Sipariş oluşturulamadı');
                    }
                })
                .fail(function (jqXHR, textStatus, errorThrown) {
                    let errorMessage = 'İşlem sırasında hata oluştu';
                    if (jqXHR.responseJSON && jqXHR.responseJSON.message) {
                        errorMessage = jqXHR.responseJSON.message;
                    } else if (errorThrown) {
                        errorMessage = errorThrown;
                    }
                    showResultModal(errorMessage, false);
                })
                .always(function () {
                    btn.prop('disabled', false);
                    btn.html(originalText);
                });
        }

        // Sonuç modalı gösterimi
        function showResultModal(message, isSuccess) {
            const modalElement = document.getElementById('resultModalCart');
            if (!modalElement) {
                alert(message); // Fallback
                return;
            }

            // Mesajı güncelle
            const messageElement = document.getElementById('resultMessage');
            if (messageElement) {
                messageElement.textContent = message;
            }

            // Icon'ı güncelle
            const icon = modalElement.querySelector('svg');
            if (icon) {
                icon.classList.remove('text-success', 'text-danger');
                icon.classList.add(isSuccess ? 'text-success' : 'text-danger');
                icon.innerHTML = isSuccess ?
                    '<?= getLucideIcon("check-circle", "w-40 h-40 mx-auto") ?>' :
                    '<?= getLucideIcon("x-circle", "w-40 h-40 mx-auto") ?>';
            }

            // Modalı göster
            resultModal?.show();
        }

        // Ürün silme onayı
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
                    removeItemModal?.hide();

                    if (data.success) {
                        // Ürünü DOM'dan kaldır
                        const productRow = document.querySelector(`.product-row[data-cart-item-id="${currentCartItemId}"]`);
                        if (productRow) productRow.remove();

                        // Toplam fiyatı güncelle
                        updateCartTotals(data.data);

                        // Sepet boşsa sayfayı yenile
                        if (data.data.cartCount === 0) {
                            location.reload();
                        }
                    } else {
                        showResultModal(data.message || 'Ürün kaldırılamadı', false);
                    }
                })
                .catch(error => {
                    showResultModal('İşlem sırasında hata oluştu: ' + error.message, false);
                });
        }

        // Sepet boşaltma fonksiyonu
        function clearCart() {
            fetch('<?= base_url('cart/clear') ?>', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '<?= csrf_token() ?>',
                    'Accept': 'application/json'
                }
            })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    confirmClearModal?.hide();

                    if (data.success) {
                        // Sepet görünümünü güncelle
                        updateCartView();
                        showResultModal(data.message || 'Sepetiniz boşaltıldı', true);
                    } else {
                        throw new Error(data.message || 'Sepet boşaltılamadı');
                    }
                })
                .catch(error => {
                    showResultModal('Bir hata oluştu: ' + error.message, false);
                });
        }

        // Sepet görünümünü güncelleme fonksiyonu
        function updateCartView() {
            // Sepet ürünlerini içeren container
            const cartContainer = document.querySelector('.row.gy-3.gx-0');
            if (!cartContainer) return;

            // Sepet boş görünümü
            const emptyCartHTML = `
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
        }

        // Yardımcı fonksiyonlar
        function updateCartTotals(data) {
            var totalPrice = 0;
            if (data.totalPrice) {
                totalPrice = typeof data.totalPrice === 'string' ?
                    parseFloat(data.totalPrice.replace(/,/g, '')) :
                    parseFloat(data.totalPrice);
            }

            // Tüm .total-price elementlerini güncelle
            document.querySelectorAll('.total-price').forEach(element => {
                element.textContent = totalPrice.toFixed(2) + ' ₺';
            });

            // Sepet sayacını güncelle
            updateCartCounters(data.cartCount || 0);
        }

        function updateCartCounters(count) {
            document.querySelectorAll('.cart-count, .total-count, .content-color span').forEach(el => {
                el.textContent = count;
            });
        }

        function updateQuantity(cartItemId, change) {
            const input = document.querySelector(`.quantity-input[data-cart-item-id="${cartItemId}"]`);
            if (!input) return;

            let newValue = parseInt(input.value) + change;
            newValue = Math.max(1, Math.min(50, newValue));

            if (newValue !== parseInt(input.value)) {
                input.value = newValue;
                updateCartItem(cartItemId, newValue);
            }
        }

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
                .then(response => {
                    if (!response.ok) throw new Error('HTTP error: ' + response.status);
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        updateCartTotals(data.data);
                    } else {
                        throw new Error(data.message || 'Güncelleme başarısız');
                    }
                })
                .catch(error => {
                    showResultModal('İşlem sırasında hata oluştu: ' + error.message, false);
                });
        }

        // Ürün silme modalını göster
        function showRemoveModal(cartItemId) {
            currentCartItemId = cartItemId;
            removeItemModal?.show();
        }
    </script>

<?= $this->endSection() ?>