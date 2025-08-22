<?php /**
 * auth/login.php
 *
 * Kullanıcı giriş ekranı (QR + Müşteri + Personel Girişi)
 */ ?>

<?= $this->extend('layouts/layout') ?>

<?= $this->section('head') ?>
<!-- Sayfa özel head içerikleri varsa buraya ekleyebilirsin (örneğin sayfa başlığı, ek CSS vs.) -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="glass-card">
    <h3 class="text-white mb-4">X CAFE Giriş</h3>

    <!-- 1) QR Kod ile Giriş Butonu -->
    <div class="d-grid mb-3">
        <button class="btn btn-primary d-flex align-items-center justify-content-center" onclick="startQrScan()">
            <?= getLucideIcon('qr-code', 'me-2') ?>
            QR Kod ile Giriş
        </button>
    </div>

    <hr class="border-light"/>

    <!-- 2) Müşteri ve Personel Girişi Bölümü -->
    <div class="row g-2">
        <div class="col-12 col-md-6">
            <button class="btn btn-outline-light w-100 d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#customerModal">
                <?= getLucideIcon('user', 'me-2') ?>
                Müşteri Girişi
            </button>
        </div>
        <div class="col-12 col-md-6">
            <button class="btn btn-outline-light w-100 d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#staffModal">
                <?= getLucideIcon('shield', 'me-2') ?>
                Personel Girişi
            </button>
        </div>
    </div>
</div>

<!-- ===================
     M O D A L L A R
     =================== -->

<!-- QR Kod Modal -->
<div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:1rem; overflow:hidden;">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="qrModalLabel">
                    <?= getLucideIcon('qr-code', 'me-2') ?> QR Kod ile Giriş
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>
            <div class="modal-body">
                <!-- Buraya QR tarama entegre edebilirsin -->
                <p class="text-center text-muted">QR kod tarayıcı entegrasyonu buraya gelecek.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>

<!-- Müşteri Giriş Modal -->
<div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:1rem; overflow:hidden;">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="customerModalLabel">
                    <?= getLucideIcon('user', 'me-2') ?> Müşteri Girişi
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>
            <div class="modal-body">
                <form id="customerLoginForm">
                    <div class="mb-3 text-start">
                        <label for="customerEmail" class="form-label text-dark">E-posta</label>
                        <input type="email" class="form-control" id="customerEmail" name="email" placeholder="ornek@eposta.com" required>
                    </div>
                    <div class="mb-3 text-start position-relative" data-password="data-password">
                        <label for="customerPassword" class="form-label text-dark">Şifre</label>
                        <input type="password" class="form-control pe-5" id="customerPassword" name="password" placeholder="Şifre" data-password-input="data-password-input" required>
                        <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y px-2" data-password-toggle="data-password-toggle">
                            <span class="uil uil-eye show"></span>
                            <span class="uil uil-eye-slash hide"></span>
                        </button>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberCustomer" name="remember_me">
                            <label class="form-check-label" for="rememberCustomer">Beni Hatırla</label>
                        </div>
                        <a href="<?= base_url('sifremi-unuttum') ?>" class="text-decoration-none">Şifremi Unuttum?</a>
                    </div>
                    <button type="submit" class="btn btn-info w-100">Giriş Yap</button>
                </form>
                <hr/>
                <p class="text-center mb-2">Hesabınız yok mu?</p>
                <button class="btn btn-outline-info w-100" onclick="openCustomerRegister()">
                    <?= getLucideIcon('user-plus', 'me-2') ?> Kayıt Ol
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Personel Giriş Modal -->
<div class="modal fade" id="staffModal" tabindex="-1" aria-labelledby="staffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:1rem; overflow:hidden;">
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title" id="staffModalLabel">
                    <?= getLucideIcon('shield', 'me-2') ?> Personel Girişi
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>
            <div class="modal-body">
                <form id="staffLoginForm">
                    <div class="mb-3 text-start">
                        <label for="staffEmail" class="form-label text-dark">E-posta</label>
                        <input type="email" class="form-control" id="staffEmail" name="email" placeholder="ornek@eposta.com" required>
                    </div>
                    <div class="mb-3 text-start position-relative" data-password="data-password">
                        <label for="staffPassword" class="form-label text-dark">Şifre</label>
                        <input type="password" class="form-control pe-5" id="staffPassword" name="password" placeholder="Şifre" data-password-input="data-password-input" required>
                        <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y px-2" data-password-toggle="data-password-toggle">
                            <span class="uil uil-eye show"></span>
                            <span class="uil uil-eye-slash hide"></span>
                        </button>
                    </div>
                    <button type="submit" class="btn btn-secondary w-100">Giriş Yap</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Müşteri Kayıt Modal -->
<div class="modal fade" id="customerRegisterModal" tabindex="-1" aria-labelledby="customerRegisterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:1rem; overflow:hidden;">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="customerRegisterModalLabel">
                    <?= getLucideIcon('user-plus', 'me-2') ?> Kayıt Ol
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>
            <div class="modal-body">
                <form id="customerRegisterForm">
                    <div class="mb-3 text-start">
                        <label for="registerName" class="form-label text-dark">Ad Soyad</label>
                        <input type="text" class="form-control" id="registerName" name="name" placeholder="Ad Soyad" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="registerEmail" class="form-label text-dark">E-posta</label>
                        <input type="email" class="form-control" id="registerEmail" name="email" placeholder="ornek@eposta.com" required>
                    </div>
                    <div class="mb-3 text-start position-relative" data-password="data-password">
                        <label for="registerPassword" class="form-label text-dark">Şifre</label>
                        <input type="password" class="form-control pe-5" id="registerPassword" name="password" placeholder="Şifre" data-password-input="data-password-input" required>
                        <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y px-2" data-password-toggle="data-password-toggle">
                            <span class="uil uil-eye show"></span>
                            <span class="uil uil-eye-slash hide"></span>
                        </button>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Kayıt Ol</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // QR butonuna tıklayınca modal açılacak
    function startQrScan() {
        var qrModal = new bootstrap.Modal(document.getElementById('qrModal'));
        qrModal.show();
    }

    // Müşteri Giriş → “Kayıt Ol” kısmına geçiş
    function openCustomerRegister() {
        var custModal = bootstrap.Modal.getInstance(document.getElementById('customerModal'));
        custModal.hide();
        var regModal = new bootstrap.Modal(document.getElementById('customerRegisterModal'));
        regModal.show();
    }

    // “Göz butonu” ile şifre göster/gizle işlevi
    document.querySelectorAll('[data-password-toggle]').forEach(function(btn){
        btn.addEventListener('click', function(){
            var container = btn.closest('[data-password]');
            var input = container.querySelector('[data-password-input]');
            var showIcon = btn.querySelector('.show');
            var hideIcon = btn.querySelector('.hide');
            if (input.type === 'password') {
                input.type = 'text';
                showIcon.style.display = 'none';
                hideIcon.style.display = 'inline';
            } else {
                input.type = 'password';
                showIcon.style.display = 'inline';
                hideIcon.style.display = 'none';
            }
        });
    });

    // Form gönderimleri (örnek alert; kendi API entegrasyonunu buraya ekle)
    document.getElementById('customerLoginForm').addEventListener('submit', function(e){
        e.preventDefault();
        alert('Müşteri girişi yapıldı (burada API çağrısı eklenecek).');
    });
    document.getElementById('staffLoginForm').addEventListener('submit', function(e){
        e.preventDefault();
        alert('Personel girişi yapıldı (burada API çağrısı eklenecek).');
    });
    document.getElementById('customerRegisterForm').addEventListener('submit', function(e){
        e.preventDefault();
        alert('Kayıt işlemi tamamlandı (burada API çağrısı eklenecek).');
    });
</script>
<?= $this->endSection() ?>
