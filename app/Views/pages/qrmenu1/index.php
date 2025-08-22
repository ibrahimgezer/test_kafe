<?= $this->extend('layouts/layout'); ?>
<?= $this->section('content') ?>

    <section class="product-category-section section-t-space section-b-space">
        <div class="custom-container">
            <div class="row g-3">
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <div class="col-6">
                            <div class="product-box clickable-div" data-href="#category-<?= esc($category['id']) ?>">
                                <div class="product-img">
                                    <?php if (!empty($category['image']) && isset($category['image']['image'])): ?>
                                        <img src="<?= esc('http://localhost/web_kafe_otomasyon/public/backend/assets/images/categories/' . $category['image']['image']) ?>"
                                             alt="<?= esc($category['title']) ?>" class="img-fluid img">
                                    <?php endif; ?>
                                </div>
                                <div class="product-content">
                                    <h5 class="content-color white-nowrap text-center"><?= esc($category['title']) ?></h5>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?= $this->endSection() ?>