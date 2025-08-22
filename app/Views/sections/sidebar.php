<div class="offcanvas sidebar-offcanvas offcanvas-start" tabindex="-1" id="sidebar">
    <div class="offcanvas-header sidebar-header" style="background:var(--bs-blue);">
        <a class="sidebar-logo" href="<?= session()->get("qrData")["data"]["url"] ?? "" ?>">
            <img class="img-fluid logo" src="<?= "http://localhost/web_kafe_otomasyon/public/backend/assets/images/cafes/".($cafe["logo"] ?? "") ?>" alt="logo">
        </a>
    </div>
    <div class="offcanvas-body">
        <?php if (!empty(session()->get("loggedCustomer"))) { ?>
            <style>
                .offcanvas.sidebar-offcanvas .offcanvas-body .link-section {
                    height: calc(100% - 100px);
                }
            </style>
            <a href="<?= base_url() ?>" class="profile-part">
                <img class="img-fluid profile-pic" src="<?= base_url("public/assets/images/avatar/1.png") ?>" alt="p8">
                <div>
                    <h3>Ad Soyad</h3>
                    <span>Profili görüntüle</span>
                </div>
            </a>
        <?php } ?>
        <ul class="link-section switch-section">
            <li class="active">
                <a href="<?= session()->get("qrData")["data"]["url"] ?? "" ?>" class="pages">
                    <?= getLucideIcon("home","sidebar-icon content-color")?>

                    <h3>Anasayfa</h3>
                </a>
            </li>
            <li>
                <a href="<?= session()->get("qrData")["data"]["url"] ?? "" ?>" class="pages">
                    <?= getLucideIcon("layout-grid","sidebar-icon content-color")?>
                    <h3>Menü</h3>
                </a>
            </li>
            <li>
                <a href="<?= base_url("sepet") ?>" class="pages">
                    <?= getLucideIcon("shopping-basket","sidebar-icon content-color")?>
                    <h3>Sepet</h3>
                </a>
            </li>
            <li>
                <a href="<?= base_url("siparislerim") ?>" class="pages">
                    <?= getLucideIcon("scroll","sidebar-icon content-color")?>
                    <h3>Siparişlerim</h3>
                </a>
            </li>
            <li>
                <a href="<?= base_url("favoriler") ?>" class="pages">
                    <?= getLucideIcon("heart","sidebar-icon content-color")?>
                    <h3>Favoriler</h3>
                </a>
            </li>
            <!--<li>
                <a href="<?php /*= base_url("gecmis-siparislerim") */?>" class="pages">
                    <?php /*= getLucideIcon("scroll-text","sidebar-icon content-color")*/?>
                    <h3>Önceki Siparişlerim</h3>
                </a>
            </li>-->
            <li>
                <div class="pages">
                    <?= getLucideIcon("moon","sidebar-icon content-color")?>
                    <h3 class="m-0">Koyu Tema</h3>
                </div>
                <div class="switch-btn">
                    <input id="dark-switch" type="checkbox">
                </div>
            </li>
        </ul>
        <?php if (!empty(session()->get("loggedCustomer"))) { ?>
            <div class="bottom-sidebar">
                <a href="login.html" class="pages">
                    <?= getLucideIcon("log-out","sidebar-icon content-color")?>
                    <h3>Çıkış Yap</h3>
                </a>
            </div>
        <?php } ?>
    </div>
</div>
