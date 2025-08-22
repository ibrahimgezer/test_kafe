<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="X Cafe">
    <meta name="keywords" content="X Cafe">
    <meta name="author" content="X Cafe">
    <link rel="icon" href="<?= base_url('public/assets/images/logo/favicon.png') ?>" type="image/x-icon">
    <title>X Cafe App</title>
    <link rel="apple-touch-icon" href="<?= base_url('public/assets/images/logo/favicon.png') ?>">
    <meta name="theme-color" content="#1a365d">
    <meta name="mobile-web-app-capable" content="yes">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="X Cafe">
    <meta name="msapplication-TileImage" content="<?= base_url('public/assets/images/logo/favicon.png') ?>">
    <meta name="msapplication-TileColor" content="#FFFFFF">

    <!-- font link -->
    <link rel="stylesheet" href="<?= base_url('public/assets/css/br-hendrix.css') ?>">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css"
          href="<?= base_url('public/assets/css/vendors/bootstrap.css') ?>">
    <!-- iconsax icon css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/css/vendors/iconsax.css') ?>">
    <!-- swiper css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/css/vendors/swiper-bundle.min.css') ?>">
    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/css/style.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/css/custom.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("public/assets/css/toastify.min.css") ?>">

    <script src="<?= base_url("public/assets/js/jquery.min.js") ?>"></script>

    <script src="<?= base_url("public/assets/js/jsQR.min.js") ?>"></script>

</head>

<body>
<!-- loader start-->
<div class="loader-wrapper" id="loader">
    <span class="loader"></span>
</div>
<!-- loader end -->

<!-- onboarding section start -->
<section class="onboarding-section pt-0">
    <div class="custom-container">
        <div class="marquee-block-wrapper">
            <div class="marquee-block marquee-top">
                <div class="marquee-inner to-left">
                    <span>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/1.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/2.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/3.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/4.jpg') ?>" alt="">
                        </div>

                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/1.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/2.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/3.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/4.jpg') ?>" alt="">
                        </div>

                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/1.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/2.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/3.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/4.jpg') ?>" alt="">
                        </div>

                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/1.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/2.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/3.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/4.jpg') ?>" alt="">
                        </div>
                    </span>
                </div>
            </div>

            <div class="marquee-block marquee-bottom">
                <div class="marquee-inner to-right">
                    <span>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/5.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/6.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/7.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/8.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/5.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/6.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/7.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/8.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/5.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/6.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/7.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/8.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/5.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/6.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/7.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/8.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/5.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/6.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/7.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/8.jpg') ?>" alt="">
                        </div>
                    </span>
                </div>
            </div>

            <div class="marquee-block marquee-top">
                <div class="marquee-inner to-left">
                    <span>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/9.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/10.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/11.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/12.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/9.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/10.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/11.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/12.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/9.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/10.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/11.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/12.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/9.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/10.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/11.jpg') ?>" alt="">
                        </div>
                        <div class="marquee-item">
                            <img class="img-fluid  marquee-img"
                                 src="<?= base_url('public/assets/images/onboarding/12.jpg') ?>" alt="">
                        </div>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="onboarding-button-content">
        <div class="custom-container">
            <h3 class="signin-gradient-text text-center mb-12">
                MERHABA
            </h3>

            <div class="px-3">
                <!-- QR Kodla Giriş Butonu (Yeni Eklenen) -->
                <a href="#" data-bs-toggle="modal" data-bs-target="#qrLoginModal"
                   class="btn btn-qrsignin d-flex align-items-center justify-content-center mb-4 lh-1 w-100 mx-auto">
                    <?= getLucideIcon("qr-code", "me-2") ?> QR KODLA GİRİŞ YAP
                </a>
            </div>

            <!--<div class="d-flex align-items-center justify-content-center gap-2 px-3">
                <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal"
                   class="btn btn-signin d-flex align-items-center justify-content-center lh-1 w-50 mx-auto">
                    GİRİŞ YAP
                    <?php /*= getLucideIcon("log-in", "ms-2") */ ?>
                </a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal"
                   class="btn btn-signin d-flex align-items-center justify-content-center w-50 mx-auto text-uppercase">
                    <?php /*= getLucideIcon("plus", "me-2") */ ?> KAYIT OL
                </a>
            </div>-->
            <!--
            <h5 class="content-color text-center mt-24">
                Henüz bir hesabınız yok mu?
            </h5>
            -->

        </div>
    </div>
</section>
<!-- onboarding section end -->

<!-- Giriş Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header with Full-Width Tabs -->
            <div class="modal-header p-0">
                <ul class="nav nav-tabs w-100" id="loginTab" role="tablist">
                    <li class="nav-item w-50" role="presentation">
                        <button class="nav-link active py-3 w-100" id="musteri-tab" data-bs-toggle="tab"
                                data-bs-target="#musteri"
                                type="button">Müşteri
                        </button>
                    </li>
                    <li class="nav-item w-50" role="presentation">
                        <button class="nav-link py-3 w-100" id="personel-tab" data-bs-toggle="tab"
                                data-bs-target="#personel"
                                type="button">Personel
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="musteri">
                        <form id="customerLoginForm">
                            <div class="mb-3">
                                <label for="musteriEmail" class="form-label">E-posta</label>
                                <input type="email" class="form-control" id="musteriEmail" autocomplete="email"
                                       placeholder="ornek@mail.com">
                            </div>
                            <div class="mb-3">
                                <label for="musteriPassword" class="form-label">Şifre</label>
                                <input type="password" class="form-control" id="musteriPassword"
                                       autocomplete="current-password" placeholder="••••••••">
                            </div>
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-signin" data-type="customer-login">Giriş Yap
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="personel">
                        <form id="personelLoginForm">
                            <div class="mb-3">
                                <label for="personelKadi" class="form-label">Kullanıcı Adı</label>
                                <input type="text" class="form-control" id="personelKadi" autocomplete="username"
                                       placeholder="Kullanıcı Adı">
                            </div>
                            <div class="mb-3">
                                <label for="personelPassword" class="form-label">Şifre</label>
                                <input type="password" class="form-control" id="personelPassword"
                                       autocomplete="current-password" placeholder="••••••••">
                            </div>
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-signin" data-type="personel-login">Personel Girişi
                                    Yap
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Custom Close Button -->
            <div class="modal-footer border-0 justify-content-center position-relative">
                <button type="button" class="btn-close-circle" data-bs-dismiss="modal" aria-label="Kapat">
                    <?= getLucideIcon("x", "svg-item") ?>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Kayıt Ol Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" id="registerForm">
            <div class="modal-header">
                <h6 class="modal-title" id="registerModalLabel">Kayıt Ol</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="registerName" class="form-label">Ad Soyad</label>
                    <input type="text" class="form-control" id="registerName" required>
                </div>
                <div class="mb-3">
                    <label for="registerEmail" class="form-label">E-posta</label>
                    <input type="email" class="form-control" id="registerEmail" autocomplete="email" required>
                </div>
                <div class="mb-3">
                    <label for="registerPassword" class="form-label">Şifre</label>
                    <input type="password" class="form-control" id="registerPassword" required
                           autocomplete="new-password">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-signin" data-type="customer-save">Kayıt Ol</button>
            </div>
        </form>
    </div>
</div>

<!-- QR Kod Giriş Modalı (Yeni Eklenen) -->
<div class="modal fade" id="qrLoginModal" tabindex="-1" aria-labelledby="qrLoginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">QR Kod ile Giriş</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>
            <div class="modal-body text-center">
                <div id="qr-scanner-container" class="mb-4">
                    <video id="qr-video" width="100%" height="auto" class="rounded-lg border-2 border-gray-300" muted
                           playsinline></video>
                    <canvas id="qr-canvas" class="d-none"></canvas>
                </div>

                <div id="qr-result" class="d-none mb-4 p-3 bg-success bg-opacity-10 text-success rounded"></div>

                <p class="text-muted mb-3">Restoran masasındaki QR kodu kamerayla tarayın</p>

                <a href="#" class="d-block mb-3 text-primary text-decoration-none" id="qr-help-link">
                    QR Kod Nasıl Kullanılır?
                </a>

                <!--<button id="manual-entry-btn" class="btn btn-outline-secondary w-100">
                    Manuel Giriş Yap
                </button>-->
            </div>
        </div>
    </div>
</div>

<!-- QR Kod Giriş Modalı (Yeni Eklenen) -->
<div class="modal fade" id="qrLoginModal1" tabindex="-1" aria-labelledby="qrLoginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">QR Kod ile Giriş</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>
            <div class="modal-body text-center">
                <div class="qr-code-placeholder mb-4">
                    <!-- QR kod görüntüsü veya oluşturucu buraya gelecek -->
                    <?= getLucideIcon("qr-code", "me-2") ?>
                    <!--<img src="<?php /*= base_url('public/assets/images/qr-placeholder.png') */ ?>" alt="QR Kod" class="img-fluid" style="max-width: 200px;">-->
                </div>
                <p class="text-muted">Mobil uygulamamızı kullanarak QR kodu taratın</p>
                <a class="qr-link">QR Kod Nasıl Kullanılır?</a>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>


<!-- bootstrap js -->
<script src="<?= base_url('public/assets/js/bootstrap.bundle.min.js') ?>"></script>
<!-- iconsax icon -->
<script src="<?= base_url('public/assets/js/iconsax-icon.js') ?>"></script>
<!-- template-setting js -->
<script src="<?= base_url('public/assets/js/template-setting.js') ?>"></script>
<!-- script js -->
<script src="<?= base_url('public/assets/js/script.js') ?>"></script>
<!-- toastify-js.js -->
<script src="<?= base_url('public/assets/js/toastify-js.js') ?>"></script>

<script>
    // DOM Elementleri
    const qrModal = document.getElementById('qrLoginModal');
    const qrVideo = document.getElementById('qr-video');
    const qrCanvas = document.getElementById('qr-canvas');
    const qrResult = document.getElementById('qr-result');
    const qrHelpLink = document.getElementById('qr-help-link');

    // Bootstrap Modal instance
    const modal = new bootstrap.Modal(qrModal);

    // QR Tarayıcı Kontrolleri
    let qrScannerActive = false;
    let qrScannerStream = null;

    // Modal gösterildiğinde
    qrModal.addEventListener('shown.bs.modal', () => {
        startQRScanner();
    });

    // Modal kapatıldığında
    qrModal.addEventListener('hidden.bs.modal', () => {
        stopQRScanner();
    });

    // Yardım linki
    if (qrHelpLink) {
        qrHelpLink.addEventListener('click', (e) => {
            e.preventDefault();
            alert('QR kod tarama kılavuzu burada gösterilebilir');
        });
    }

    // QR tarayıcıyı başlat
    function startQRScanner() {
        if (qrScannerActive) return;
        navigator.mediaDevices.getUserMedia({video: {facingMode: "environment"}})
            .then(function (stream) {
                qrScannerActive = true;
                qrScannerStream = stream;
                qrVideo.srcObject = stream;
                qrVideo.play()
                    .then(() => {
                        tick();
                    })
                    .catch(err => {
                        console.error("Video play error:", err);
                        showError("Kamera başlatılamadı");
                    });
            })
            .catch(function (err) {
                console.error("Kamera erişim hatası:", err);
                showError("Kameraya erişim izni verilmedi");
            });
    }

    // QR tarayıcıyı durdur
    function stopQRScanner() {
        if (!qrScannerActive) return;
        if (qrScannerStream) {
            qrScannerStream.getTracks().forEach(track => track.stop());
        }
        //qrVideo.srcObject = null;
        qrScannerActive = false;
        qrScannerStream = null;
    }

    // Hata mesajını göster
    function showError(message) {
        if (!qrResult) return;

        qrResult.textContent = message;
        qrResult.classList.remove('d-none');
        qrResult.classList.add('bg-danger', 'bg-opacity-10', 'text-danger');
        qrResult.classList.remove('bg-success', 'text-success');
    }

    // QR kodu tespit et
    function tick() {
        if (!qrScannerActive || !qrCanvas || !qrVideo) return;

        try {
            if (qrVideo.readyState === qrVideo.HAVE_ENOUGH_DATA) {
                qrCanvas.height = qrVideo.videoHeight;
                qrCanvas.width = qrVideo.videoWidth;
                const ctx = qrCanvas.getContext('2d');
                ctx.drawImage(qrVideo, 0, 0, qrCanvas.width, qrCanvas.height);

                const imageData = ctx.getImageData(0, 0, qrCanvas.width, qrCanvas.height);

                // jsQR kütüphanesinin yüklü olduğundan emin olun
                if (typeof jsQR !== 'undefined') {
                    const code = jsQR(imageData.data, imageData.width, imageData.height, {
                        inversionAttempts: "dontInvert",
                    });

                    if (code) {
                        handleQRCode(code.data);
                        return; // Taramayı durdur
                    }
                } else {
                    console.error("jsQR kütüphanesi yüklenmemiş");
                    showError("QR tarayıcı başlatılamadı");
                    stopQRScanner();
                    return;
                }
            }
            requestAnimationFrame(tick);
        } catch (error) {
            console.error("QR tarama hatası:", error);
            showError("Tarama sırasında hata oluştu");
            stopQRScanner();
        }
    }

    // QR kodu işle
    function handleQRCode(data) {
        if (!qrResult) return false;

        stopQRScanner();

        qrResult.textContent = `Restoran bulundu, yönlendiriliyorsunuz`;
        qrResult.classList.remove('d-none');
        qrResult.classList.add('bg-success', 'bg-opacity-10', 'text-success');
        qrResult.classList.remove('bg-danger', 'text-danger');

        // 1.5 saniye sonra modalı kapat ve yönlendir
        setTimeout(() => {
            window.location.href = data;
        }, 1500);

        return false;
    }

</script>

</body>

</html>