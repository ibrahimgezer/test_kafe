<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($cafe['title']) ?> Menü</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Toastify CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <style>
        :root {
            --primary-color: #ff4757;
            --primary-hover: #ff6b81;
            --secondary-color: #2f3542;
            --light-color: #f1f2f6;
            --dark-color: #2f3542;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: var(--dark-color);
        }

        .cafe-header {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
            url('<?= !empty($cafe['logo']) ?  get_panel_image_url('public/backend/assets/images/cafes/' . $cafe['logo']) : get_panel_image_url('themes/phoenix/assets/img/restaurant-bg.jpg') ?>');
            background-size: cover;
            background-position: center;
            min-height: 300px;
            color: white;
            padding: 2rem 0;
            position: relative;
        }

        .cafe-logo {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid white;
            margin-bottom: 1rem;
        }

        .table-badge {
            background-color: rgba(255, 255, 255, 0.2);
            font-size: 1rem;
            padding: 0.5rem 1.2rem;
        }

        .call-waiter-btn {
            background-color: var(--primary-color);
            border: none;
            transition: all 0.3s;
        }

        .call-waiter-btn:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }

        .categories-nav {
            background-color: white;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .category-link {
            text-decoration: none;
            color: var(--dark-color);
            transition: all 0.3s;
            text-align: center;
            padding: 0.5rem 1rem;
            min-width: 100px;
        }

        .category-link:hover, .category-link.active {
            color: var(--primary-color);
        }

        .category-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 0.5rem;
        }

        .menu-section {
            padding: 3rem 0;
        }

        .category-title {
            position: relative;
            margin-bottom: 2rem;
            padding-bottom: 0.5rem;
        }

        .category-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 3px;
            background-color: var(--primary-color);
        }

        .product-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            margin-bottom: 1.5rem;
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .product-img {
            height: 180px;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .product-card:hover .product-img {
            transform: scale(1.05);
        }

        .product-body {
            padding: 1.5rem;
        }

        .product-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .product-description {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .product-price {
            font-weight: bold;
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .add-to-cart-btn {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .add-to-cart-btn:hover {
            background-color: var(--primary-hover);
            transform: rotate(90deg);
        }

        .cart-fab {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 4px 20px rgba(255, 71, 87, 0.4);
            z-index: 1030;
            transition: all 0.3s;
        }

        .cart-fab:hover {
            background-color: var(--primary-hover);
            transform: scale(1.1);
        }

        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: white;
            color: var(--primary-color);
            width: 25px;
            height: 25px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .cafe-header {
                min-height: 250px;
                padding: 1.5rem 0;
            }

            .cafe-logo {
                width: 80px;
                height: 80px;
            }

            .categories-scroll {
                overflow-x: auto;
                flex-wrap: nowrap;
                padding-bottom: 0.5rem;
            }
        }

        @media (max-width: 576px) {
            .table-info {
                position: static;
                margin-top: 1rem;
            }

            .product-img {
                height: 150px;
            }
        }
    </style>
</head>
<body>
<!-- Cafe Header Section -->
<header class="cafe-header d-flex align-items-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8 text-center text-md-start">
                <div class="cafe-info">
                    <?php if (!empty($cafe['logo'])): ?>
                        <img src="<?= get_panel_image_url('public/backend/assets/images/cafes/' . $cafe['logo']) ?>" alt="<?= esc($cafe['title']) ?>" class="cafe-logo">
                    <?php endif; ?>
                    <?php /*= get_panel_image_url('public/backend/assets/images/cafes/' . $cafe['logo']) */?>
                    <h1 class="display-5 fw-bold mb-2"><?= esc($cafe['title']) ?></h1>
                    <p class="lead mb-0"><i class="fas fa-map-marker-alt me-2"></i><?= esc($cafe['location']) ?></p>
                </div>
            </div>
            <div class="col-md-4 text-center text-md-end mt-4 mt-md-0">
                <div class="table-info">
                    <span class="badge table-badge rounded-pill mb-2">Masa <?= $tableNumber ?></span>
                    <button id="callWaiterBtn" class="btn call-waiter-btn rounded-pill px-4 py-2">
                        <i class="fas fa-bell me-2"></i>Garson Çağır
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Categories Navigation -->
<nav class="categories-nav py-3">
    <div class="container">
        <div class="d-flex categories-scroll">
            <?php foreach ($categories as $category): ?>
                <a href="#category-<?= $category['id'] ?>" class="category-link">
                    <?php if (!empty($category['image'])): ?>
                        <img src="<?= get_panel_image_url('public/backend/assets/images/categories/' . $category['image']['image']) ?>" alt="<?= esc($category['title']) ?>" class="category-img d-block mx-auto">
                    <?php endif; ?>
                    <span class="d-block"><?= esc($category['title']) ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</nav>

<!-- Menu Sections -->
<main class="menu-section">
    <div class="container">
        <?php foreach ($categories as $category): ?>
            <section id="category-<?= $category['id'] ?>" class="mb-5">
                <h2 class="category-title fw-bold">
                    <?= esc($category['title']) ?>
                    <?php if (!empty($category['description'])): ?>
                        <small class="d-block text-muted fs-6 fw-normal mt-1"><?= esc($category['description']) ?></small>
                    <?php endif; ?>
                </h2>

                <div class="row">
                    <?php foreach ($category['products'] as $product): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="product-card h-100">
                                <div class="overflow-hidden">
                                    <?php if (!empty($product['images'])): ?>
                                        <img src="<?= get_panel_image_url('public/backend/assets/images/products/' . $product['images'][0]['image']) ?>" alt="<?= esc($product['title']) ?>" class="product-img w-100">
                                    <?php else: ?>
                                        <img src="<?= get_panel_image_url('themes/phoenix/assets/img/food-placeholder.jpg') ?>" alt="Ürün resmi yok" class="product-img w-100">
                                    <?php endif; ?>
                                </div>
                                <div class="product-body">
                                    <h3 class="product-title"><?= esc($product['title']) ?></h3>
                                    <p class="product-description"><?= esc($product['description']) ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="product-price"><?= number_format($product['price'], 2) ?> ₺</span>
                                        <button class="add-to-cart-btn" data-product-id="<?= $product['id'] ?>">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endforeach; ?>
    </div>
</main>

<!-- Cart Floating Button -->
<a href="#" class="cart-fab" id="cartButton">
    <i class="fas fa-shopping-basket"></i>
    <span class="cart-badge" id="cartCount">0</span>
</a>

<!-- Call Waiter Modal -->
<div class="modal fade" id="callWaiterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Garson Çağır</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Garson masanıza çağrılmıştır. Lütfen bekleyiniz.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Toastify JS -->
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script>
    $(document).ready(function() {
        let cart = [];

        // Garson çağırma butonu
        $('#callWaiterBtn').click(function() {
            $.ajax({
                url: '<?= site_url('call-waiter') ?>',
                method: 'POST',
                data: {
                    qr_code: '<?= $qrData["code"] ?>',
                    table_id: '<?= $qrData["table_id"] ?>'
                },
                success: function(response) {
                    if(response.status === 'success') {
                        const modal = new bootstrap.Modal(document.getElementById('callWaiterModal'));
                        modal.show();

                        setTimeout(() => {
                            modal.hide();
                        }, 3000);
                    }
                },
                error: function() {
                    Toastify({
                        text: "Bir hata oluştu. Lütfen tekrar deneyin.",
                        duration: 3000,
                        close: true,
                        gravity: "bottom",
                        position: "right",
                        backgroundColor: "#ff4757",
                    }).showToast();
                }
            });
        });

        // Sepete ürün ekleme
        $('.add-to-cart-btn').click(function() {
            const productId = $(this).data('product-id');
            const productCard = $(this).closest('.product-card');
            const productTitle = productCard.find('.product-title').text();
            const productPrice = productCard.find('.product-price').text();

            cart.push({
                id: productId,
                title: productTitle,
                price: productPrice
            });

            updateCartCount();

            Toastify({
                text: `${productTitle} sepete eklendi`,
                duration: 3000,
                close: true,
                gravity: "bottom",
                position: "right",
                backgroundColor: "#4caf50",
            }).showToast();
        });

        // Sepet butonu
        $('#cartButton').click(function(e) {
            e.preventDefault();

            if(cart.length === 0) {
                Toastify({
                    text: "Sepetiniz boş",
                    duration: 3000,
                    close: true,
                    gravity: "bottom",
                    position: "right",
                    backgroundColor: "#ff9800",
                }).showToast();
            } else {
                // Burada sipariş sayfasına yönlendirme yapılabilir
                alert(`${cart.length} ürün sepete eklendi. Siparişi tamamlamak için ilerleyin.`);
            }
        });

        // Kategori linklerine tıklandığında
        $('.category-link').click(function(e) {
            e.preventDefault();
            const target = $(this).attr('href');

            $('html, body').animate({
                scrollTop: $(target).offset().top - 100
            }, 500);

            $('.category-link').removeClass('active');
            $(this).addClass('active');
        });

        // Sepet sayacını güncelle
        function updateCartCount() {
            $('#cartCount').text(cart.length);
        }

        // Sayfa yüklendiğinde aktif kategoriyi belirle
        function setActiveCategory() {
            const scrollPosition = $(window).scrollTop();

            $('section').each(function() {
                const sectionTop = $(this).offset().top - 150;
                const sectionBottom = sectionTop + $(this).outerHeight();

                if(scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                    const id = $(this).attr('id');
                    $('.category-link').removeClass('active');
                    $(`.category-link[href="#${id}"]`).addClass('active');
                    return false;
                }
            });
        }

        $(window).scroll(setActiveCategory);
        setActiveCategory();
    });
</script>
</body>
</html>