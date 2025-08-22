<ul class="bottom-menu">

    <?php
    $currentUrl = current_url();
    $isLoggedIn = !empty(session()->get("loggedCustomer"));
    $baseUrl = base_url();
    $menuUrl = $qrInfo["url"] ?? $baseUrl;
    $isProductsPage = str_contains($currentUrl, '_products');
    ?>

    <li style="cursor: pointer">
        <a href="<?= $menuUrl ?>" class="menu-a <?= (str_contains($currentUrl, $menuUrl) || $isProductsPage) ? 'active' : 'title-color-transparent' ?>">
            <?= getLucideIcon("layout-grid", "text-content w-30 h-24 ") ?>
            <h6>Menü</h6>
        </a>
    </li>
    <li style="cursor: pointer">
        <a href="<?= base_url("sepet") ?>" class="menu-a <?= str_contains($currentUrl, 'sepet') ? 'active' : 'title-color-transparent' ?>">
            <?= getLucideIcon("shopping-basket", "w-30 h-24") ?>
            <h6>Sepet</h6>
        </a>
    </li>

    <li style="cursor: pointer">
        <a href="#sidebar" class="bottom-side_menu-button sidebar-btn" data-bs-toggle="offcanvas">
            <?= getLucideIcon("align-center", "w-35 h-35") ?>
        </a>
    </li>

    <li style="cursor: pointer">
        <a href="<?= $isLoggedIn ? base_url("favoriler") : 'javascript:void(0);' ?>"
           class="menu-a sepet-a <?= str_contains($currentUrl, 'favoriler') ? 'active' : 'title-color-transparent' ?>"
            <?= !$isLoggedIn ? 'onclick="showLoginAlert()"' : '' ?>>
            <?= getLucideIcon("heart", "text-content w-25 h-24") ?>
            <h6>Favoriler</h6>
        </a>
    </li>

    <li style="cursor: pointer">
        <a href="<?= $isLoggedIn ? base_url("profil") : 'javascript:void(0);' ?>"
           class="menu-a <?= str_contains($currentUrl, 'profil') ? 'active' : 'title-color-transparent' ?>"
            <?= !$isLoggedIn ? 'onclick="showLoginAlert()"' : '' ?>>
            <?= getLucideIcon("user-check", "text-content w-30 h-24") ?>
            <h6>Profil</h6>
        </a>
    </li>
</ul>

<!-- Giriş yapma uyarısı için modal -->
<div class="modal fade" id="loginAlertModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-4">
                <?=getLucideIcon("info","w-40 h-40 mb-2")?>
                <h5 class="mb-3">Giriş Yapmalısınız</h5>
                <p>Bu özelliği kullanabilmek için lütfen giriş yapın.</p>
                <div class="d-flex gap-2 justify-content-center mt-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                    <a href="<?= base_url('auth') ?>" class="btn btn-primary">Giriş Yap</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showLoginAlert() {
        var loginModal = new bootstrap.Modal(document.getElementById('loginAlertModal'));
        loginModal.show();
    }
</script>