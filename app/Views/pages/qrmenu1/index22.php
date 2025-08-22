<?= $this->extend('layouts/layout'); ?>
<?= $this->section('content') ?>

    <section class="product-category-section section-t-space section-b-space">
        <div class="custom-container">
            <div class="row g-3">
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>

                        <div class="col-6">
                            <div href="#category-<?= esc($category['id']) ?>" class="product-box">
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

    <section>
        <div class="custom-container">
            <div class="title">
                <div class="d-flex align-items-center gap-2">
                    <h3>Ürünler</h3>
                </div>
                <!--<a href="sale.html" class="see-all">See all</a>-->
            </div>

            <div class="row g-3">
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <?php if (!empty($category['products'])): ?>
                            <?php foreach ($category['products'] as $product): ?>
                                <div class="col-6">
                                    <div class="product-box">
                                        <div class="product-img">
                                            <?php if (!empty($product['images']) && isset($product['images'][0]['image'])): ?>
                                                <img src="<?= esc('http://localhost/web_kafe_otomasyon/public/backend/assets/images/products/' . $product['images'][0]['image']) ?>"
                                                     alt="<?= esc($product['title']) ?>" class="img-fluid img">
                                            <?php else: ?>
                                                <!-- Placeholder image if no product image exists -->
                                                <img src="<?= base_url('public/assets/images/placeholder.jpg') ?>"
                                                     alt="No image" class="img-fluid img">
                                            <?php endif; ?>

                                            <div class="like-icon animate">
                                                <img class="img-fluid icon outline-icon"
                                                     src="<?= base_url("public/assets/images/svg/heart-outline.svg") ?>"
                                                     alt="">
                                                <img class="img-fluid icon fill-icon"
                                                     src="<?= base_url("public/assets/images/svg/heart-fill.svg") ?>"
                                                     alt="">
                                                <div class="effect-group">
                                                    <span class="effect"></span>
                                                    <span class="effect"></span>
                                                    <span class="effect"></span>
                                                    <span class="effect"></span>
                                                    <span class="effect"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <a href="cart.html" class="add-icon">
                                                <i class="iconsax" data-icon="add"></i>
                                            </a>
                                            <h6 class="content-color white-nowrap"><?= esc($product['title']) ?></h6>
                                            <a href="product-details.html">
                                                <h5 class="title-color fw-medium white-nowrap mt-1"><?= esc($product['description']) ?></h5>
                                            </a>
                                            <ul class="rating-list">
                                                <?php for ($i = 0; $i < 5; $i++): ?>
                                                    <li>
                                                        <img src="<?= base_url("public/assets/images/svg/star-fill.svg") ?>"
                                                             alt="star">
                                                    </li>
                                                <?php endfor; ?>
                                            </ul>
                                            <div class="bottom-content">
                                                <h5 class="price"><?= number_format($product['price'] ?? 0, 2) ?> ₺</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!--<section class=" position-relative">
        <div class="swiper banner-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <a href="shop.html" class="banner-box">
                        <img class="img-fluid banner-img" src="assets/images/banner/1.png" alt="banner">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="shop.html" class="banner-box">
                        <img class="img-fluid banner-img" src="assets/images/banner/2.png" alt="banner">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="shop.html" class="banner-box">
                        <img class="img-fluid banner-img" src="assets/images/banner/3.png" alt="banner">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="shop.html" class="banner-box">
                        <img class="img-fluid banner-img" src="assets/images/banner/4.png" alt="banner">
                    </a>
                </div>
            </div>
            <div class="swiper-pagination banner-pagination"></div>
        </div>
    </section>-->
    <!--

      <section>
          <div class="custom-container">
              <div class="title">
                  <h3>Recommended for you</h3>
                  <a href="shop.html" class="see-all">See all</a>
              </div>
              <div class="row gy-3 gx-0">
                  <div class="col-12">
                      <div class="product-box vertical-product">
                          <a href="product-details.html" class="product-img">
                              <img src="assets/images/product/5.png" class="img-fluid" alt="">
                          </a>
                          <div class="product-content">
                              <h6 class="content-color">Mobile</h6>
                              <a href="product-details.html" class="product-top">
                                  <h5 class="title-color white-nowrap">Latest Smart Mobile </h5>
                              </a>
                              <div class="bottom-content">
                                  <h5 class="price">$450 <del>$460</del></h5>
                              </div>
                          </div>
                          <div class="like-icon animate ">
                              <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg" alt="">
                              <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">
                              <div class="effect-group">
                                  <span class="effect"></span>
                                  <span class="effect"></span>
                                  <span class="effect"></span>
                                  <span class="effect"></span>
                                  <span class="effect"></span>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-12">
                      <div class="product-box vertical-product">
                          <a href="product-details.html" class="product-img">
                              <img src="assets/images/product/6.png" class="img-fluid" alt="">
                          </a>
                          <div class="product-content">
                              <h6 class="content-color">Laptop</h6>
                              <a href="product-details.html" class="product-top">
                                  <h5 class="title-color white-nowrap">Latest Smart laptop </h5>
                              </a>
                              <div class="bottom-content">
                                  <h5 class="price">$550</h5>
                              </div>
                          </div>
                          <div class="like-icon animate ">
                              <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg" alt="">
                              <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">
                              <div class="effect-group">
                                  <span class="effect"></span>
                                  <span class="effect"></span>
                                  <span class="effect"></span>
                                  <span class="effect"></span>
                                  <span class="effect"></span>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-12">
                      <div class="product-box vertical-product">
                          <a href="product-details.html" class="product-img">
                              <img src="assets/images/product/7.png" class="img-fluid" alt="">
                          </a>
                          <div class="product-content">
                              <h6 class="content-color">Game</h6>
                              <a href="product-details.html" class="product-top">
                                  <h5 class="title-color white-nowrap">Game Controller </h5>
                              </a>
                              <div class="bottom-content">
                                  <h5 class="price">$150</h5>
                              </div>
                          </div>
                          <div class="like-icon animate ">
                              <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg" alt="">
                              <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">
                              <div class="effect-group">
                                  <span class="effect"></span>
                                  <span class="effect"></span>
                                  <span class="effect"></span>
                                  <span class="effect"></span>
                                  <span class="effect"></span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>

      <section class="product-category-section section-t-space section-b-space mt-24">
          <div class="custom-container">
              <div class="title">
                  <h3>All Electronic Device For Home & Office</h3>
                  <a href="shop.html" class="btn btn-small shop-btn">Shop Now</a>
              </div>

              <div class="row g-3">
                  <div class="col-6">
                      <a href="shop.html" class="product-category">
                          <div class="product-category-img">
                              <img src="assets/images/product/8.png" class="img-fluid categories-img" alt="">
                          </div>
                          <h5>Mobile</h5>
                      </a>
                  </div>
                  <div class="col-6">
                      <a href="shop.html" class="product-category">
                          <div class="product-category-img">
                              <img src="assets/images/product/6.png" class="img-fluid categories-img" alt="">
                          </div>
                          <h5>Laptop</h5>
                      </a>
                  </div>
                  <div class="col-6">
                      <a href="shop.html" class="product-category">
                          <div class="product-category-img">
                              <img src="assets/images/product/10.png" class="img-fluid categories-img" alt="">
                          </div>
                          <h5>Tablet</h5>
                      </a>
                  </div>
                  <div class="col-6">
                      <a href="shop.html" class="product-category">
                          <div class="product-category-img">
                              <img src="assets/images/product/9.png" class="img-fluid categories-img" alt="">
                          </div>
                          <h5>MacBook</h5>
                      </a>
                  </div>
              </div>
          </div>
      </section>

      <section>
          <div class="custom-container">
              <div class="title">
                  <h3>Deals of The Day</h3>
                  <a href="deals.html" class="see-all">See all</a>
              </div>
              <a href="shop.html" class="banner-box">
                  <img class="img-fluid banner-img w-100 radius-10" src="assets/images/banner/5.png" alt="banner">
              </a>
          </div>
      </section>

      <section>
          <div class="custom-container">
              <div class="title">
                  <h3>Best Selling</h3>
                  <a href="#" class="see-all">See all</a>
              </div>

              <div class="row g-3">
                  <div class="col-6">
                      <div class="product-box">
                          <div class="product-img">
                              <div class="badge-img">
                                  <span>Hot</span>
                              </div>
                              <img src="assets/images/product/1.png" class="img-fluid img" alt="">
                              <div class="like-icon animate ">
                                  <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg"
                                       alt="">
                                  <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">
                                  <div class="effect-group">
                                      <span class="effect"></span>
                                      <span class="effect"></span>
                                      <span class="effect"></span>
                                      <span class="effect"></span>
                                      <span class="effect"></span>
                                  </div>
                              </div>
                          </div>
                          <div class="product-content">
                              <a href="cart.html" class="add-icon">
                                  <i class="iconsax" data-icon="add"></i>
                              </a>
                              <h6 class="content-color white-nowrap">Mobile</h6>
                              <a href="product-details.html">
                                  <h5 class="title-color fw-medium white-nowrap mt-1">Latest Smart Mobile Phone</h5>
                              </a>
                              <ul class="rating-list">
                                  <li>
                                      <img src="assets/images/svg/star-fill.svg" alt="star">
                                  </li>
                                  <li>
                                      <img src="assets/images/svg/star-fill.svg" alt="star">
                                  </li>
                                  <li>
                                      <img src="assets/images/svg/star-fill.svg" alt="star">
                                  </li>
                                  <li>
                                      <img src="assets/images/svg/star-fill.svg" alt="star">
                                  </li>
                                  <li>
                                      <img src="assets/images/svg/star-outline.svg" alt="star">
                                  </li>
                              </ul>
                              <div class="bottom-content">
                                  <h5 class="price">$320 <del>$350</del></h5>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-6">
                      <div class="product-box">
                          <div class="product-img">
                              <img src="assets/images/product/2.png" class="img-fluid img" alt="">
                              <div class="like-icon animate active inactive">
                                  <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg"
                                       alt="">
                                  <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">
                                  <div class="effect-group">
                                      <span class="effect"></span>
                                      <span class="effect"></span>
                                      <span class="effect"></span>
                                      <span class="effect"></span>
                                      <span class="effect"></span>
                                  </div>
                              </div>
                          </div>


                          <div class="product-content">
                              <a href="cart.html" class="add-icon">
                                  <i class="iconsax" data-icon="add"></i>
                              </a>

                              <a href="product-details.html">
                                  <h6 class="content-color white-nowrap">Speaker</h6>
                                  <h5 class="title-color fw-medium white-nowrap mt-1">Wireless Audio System</h5>
                              </a>
                              <ul class="rating-list">
                                  <li>
                                      <img src="assets/images/svg/star-fill.svg" alt="star">
                                  </li>
                                  <li>
                                      <img src="assets/images/svg/star-fill.svg" alt="star">
                                  </li>
                                  <li>
                                      <img src="assets/images/svg/star-fill.svg" alt="star">
                                  </li>
                                  <li>
                                      <img src="assets/images/svg/star-fill.svg" alt="star">
                                  </li>
                                  <li>
                                      <img src="assets/images/svg/star-outline.svg" alt="star">
                                  </li>
                              </ul>
                              <div class="bottom-content">
                                  <h5 class="price">$20 <del>$50</del></h5>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="col-6">
                      <div class="product-box">
                          <div class="product-img">
                              <img src="assets/images/product/3.png" class="img-fluid img" alt="">
                              <div class="like-icon animate ">
                                  <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg"
                                       alt="">
                                  <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">
                                  <div class="effect-group">
                                      <span class="effect"></span>
                                      <span class="effect"></span>
                                      <span class="effect"></span>
                                      <span class="effect"></span>
                                      <span class="effect"></span>
                                  </div>
                              </div>
                          </div>
                          <div class="product-content">
                              <a href="cart.html" class="add-icon">
                                  <i class="iconsax" data-icon="add"></i>
                              </a>
                              <h6 class="content-color white-nowrap">Laptop</h6>
                              <a href="product-details.html">
                                  <h5 class="title-color fw-medium white-nowrap mt-1">Latest Smart laptop</h5>
                              </a>
                              <ul class="rating-list">
                                  <li>
                                      <img src="assets/images/svg/star-fill.svg" alt="star">
                                  </li>
                                  <li>
                                      <img src="assets/images/svg/star-fill.svg" alt="star">
                                  </li>
                                  <li>
                                      <img src="assets/images/svg/star-fill.svg" alt="star">
                                  </li>
                                  <li>
                                      <img src="assets/images/svg/star-fill.svg" alt="star">
                                  </li>
                                  <li>
                                      <img src="assets/images/svg/star-outline.svg" alt="star">
                                  </li>
                              </ul>
                              <div class="bottom-content">
                                  <h5 class="price">$200 <del>$250</del></h5>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-6">
                      <div class="product-box">
                          <div class="product-img">
                              <div class="badge-img">
                                  <span>Hot</span>
                              </div>
                              <img src="assets/images/product/4.png" class="img-fluid img" alt="">
                              <div class="like-icon animate active inactive">
                                  <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg"
                                       alt="">
                                  <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">
                                  <div class="effect-group">
                                      <span class="effect"></span>
                                      <span class="effect"></span>
                                      <span class="effect"></span>
                                      <span class="effect"></span>
                                      <span class="effect"></span>
                                  </div>
                              </div>
                          </div>

                          <div class="product-content">
                              <a href="cart.html" class="add-icon">
                                  <i class="iconsax" data-icon="add"></i>
                              </a>

                              <a href="product-details.html">
                                  <h6 class="content-color white-nowrap">Headphone</h6>
                                  <h5 class="title-color fw-medium white-nowrap mt-1">Wireless Bluetooth Headphone</h5>
                              </a>
                              <ul class="rating-list">
                                  <li>
                                      <img src="assets/images/svg/star-fill.svg" alt="star">
                                  </li>
                                  <li>
                                      <img src="assets/images/svg/star-fill.svg" alt="star">
                                  </li>
                                  <li>
                                      <img src="assets/images/svg/star-fill.svg" alt="star">
                                  </li>
                                  <li>
                                      <img src="assets/images/svg/star-fill.svg" alt="star">
                                  </li>
                                  <li>
                                      <img src="assets/images/svg/star-outline.svg" alt="star">
                                  </li>
                              </ul>
                              <div class="bottom-content">
                                  <h5 class="price">$10 <del>$20</del></h5>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>

      <section>
          <div class="custom-container">
              <div class="title">
                  <h3>Deals of The Week</h3>
                  <a href="deals.html" class="see-all">See all</a>
              </div>
              <a href="shop.html" class="banner-box">
                  <img class="img-fluid banner-img w-100 radius-10" src="assets/images/banner/6.png" alt="banner">
              </a>
          </div>
      </section>

      <section class="section-b-space">
          <div class="custom-container">
              <div class="title">
                  <h3>Shop for her</h3>
                  <a href="shop.html" class="see-all">See all</a>
              </div>
              <div class="row gy-3 gx-0">
                  <div class="col-12">
                      <div class="product-box vertical-product">
                          <a href="product-details.html" class="product-img">
                              <img src="assets/images/product/11.png" class="img-fluid" alt="">
                          </a>
                          <div class="product-content">
                              <h6 class="content-color">Apple</h6>
                              <a href="product-details.html" class="product-top">
                                  <h5 class="title-color white-nowrap">Smart TV System </h5>
                              </a>
                              <div class="bottom-content">
                                  <h5 class="price">$450 <del>$460</del></h5>
                              </div>
                          </div>
                          <div class="like-icon animate ">
                              <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg" alt="">
                              <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">
                              <div class="effect-group">
                                  <span class="effect"></span>
                                  <span class="effect"></span>
                                  <span class="effect"></span>
                                  <span class="effect"></span>
                                  <span class="effect"></span>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-12">
                      <div class="product-box vertical-product">
                          <a href="product-details.html" class="product-img">
                              <img src="assets/images/product/12.png" class="img-fluid" alt="">
                          </a>
                          <div class="product-content">
                              <h6 class="content-color">Gadgets</h6>
                              <a href="product-details.html" class="product-top">
                                  <h5 class="title-color white-nowrap">Latest Smart Camera </h5>
                              </a>
                              <div class="bottom-content">
                                  <h5 class="price">$450 <del>$460</del></h5>
                              </div>
                          </div>
                          <div class="like-icon animate ">
                              <img class="img-fluid icon outline-icon" src="assets/images/svg/heart-outline.svg" alt="">
                              <img class="img-fluid icon fill-icon" src="assets/images/svg/heart-fill.svg" alt="">
                              <div class="effect-group">
                                  <span class="effect"></span>
                                  <span class="effect"></span>
                                  <span class="effect"></span>
                                  <span class="effect"></span>
                                  <span class="effect"></span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>

    -->
<?= $this->endSection() ?>