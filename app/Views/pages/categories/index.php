<?= $this->extend('layouts/layout'); ?>

<?= $this->section('content') ?>

    <header class="main-header">
        <a class="custom-container d-block" href="<?= $qrInfo["url"] ?? ""?>">
            <div class="header-panel">
                <img class="img-fluid logo" src="<?= "http://localhost/web_kafe_otomasyon/public/backend/assets/images/cafes/".($cafe["logo"] ?? "") ?>" alt="logo">
                <h3><?= esc($cafe["title"] ?? "") ?></h3>
            </div>
        </a>
    </header>

    <section class="product-category-section section-t-space section-b-space" style="padding-top: 24px">
        <div class="custom-container">
            <div class="row g-3">
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <div class="col-6">
                            <a class="product-box d-block" href="<?= base_url("_products/" . $category['id']) ?>">
                                <div class="product-img">
                                    <?php if (!empty($category['image']) && isset($category['image']['image'])): ?>
                                        <img src="<?= esc('http://localhost/web_kafe_otomasyon/public/backend/assets/images/categories/' . $category['image']['image']) ?>"
                                             alt="<?= esc($category['title']) ?>" class="img-fluid img">
                                    <?php endif; ?>
                                    <!--<div class="badge-img">
                                        <span>Yeni</span>
                                    </div>-->
                                </div>
                            </a>
                            <h4 class="content-color white-nowrap text-center mt-3">
                                <?= esc($category['title']) ?>
                            </h4>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>