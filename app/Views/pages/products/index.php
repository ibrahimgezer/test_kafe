<?= $this->extend('layouts/layout'); ?>

<?= $this->section('content') ?>

    <style>
        .search-results-container {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #eee;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            max-height: 300px;
            overflow-y: auto;
            margin-top: 5px;
        }

        .search-results-inner {
            padding: 5px;
        }

        .search-result-item {
            cursor: pointer;
            transition: background-color 0.2s;
            border-bottom: 1px solid #f5f5f5;
        }

        .search-result-item:last-child {
            border-bottom: none;
        }

        .search-result-item:hover {
            background-color: #f9f9f9;
        }

        .no-products {
            min-height: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .no-products i {
            font-size: 4rem;
            color: #e0e0e0;
            margin-bottom: 1rem;
        }

        .no-products h5 {
            color: #555;
            font-weight: 500;
        }

        .no-products p {
            color: #888;
        }

        .note-modal textarea {
            min-height: 100px;
            resize: none;
            background: transparent;
            border: 1px solid rgba(var(--content-color), 1);
            color: rgba(var(--black), 1);
        }

        .note-modal textarea ::placeholder {
            color: rgba(var(--white), 1) !important;
        }
    </style>

    <header class="main-header">
        <div class="custom-container">
            <div class="header-panel">
                <a onclick="history.back();">
                    <?= getLucideIcon("arrow-left", "icon-btn back-arrow") ?>
                </a>
                <h3 class="py-4"><?= $category["title"] ?? "" ?></h3>
            </div>
        </div>
    </header>

<?php if (!empty($products)): ?>

    <section class="section-sm-t-space">
        <div class="custom-container">
            <form class="theme-form search-form  p-0 d-flex align-content-center gap-2">
                <div class="form-group w-100">
                    <div class="form-input">
                        <input type="search" class="form-control search " id="input_product_name"
                               placeholder="Ara .....">
                        <?= getLucideIcon("search","search-icon") ?>
                        <?= getLucideIcon("mic","mic-icon") ?>
                    </div>
                    <div id="searchResults" class="search-results-container" style="display: none;">
                        <div class="search-results-inner">
                            <!-- Öneriler buraya dinamik olarak eklenecek -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="section-sm-t-space">
        <div class="custom-container">
            <div class="filter-grid-btn d-flex align-items-center justify-content-end gap-3 mb-2">
                <a href="#sort" data-bs-toggle="offcanvas"
                   class="content-color d-flex align-items-center justify-content-end gap-2 p-2 w-50">
                    <?= getLucideIcon("sliders-horizontal","me-1") ?>Sırala
                </a>
            </div>
        </div>
    </section>

<?php endif; ?>

    <section class="section-b-space" style="<?= !empty($products) ? 'padding-bottom:125px' : '' ?>">
        <div class="custom-container">
            <div class="row g-3" id="productsContainer">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-6">
                            <div class="product-box">
                                <div class="product-img">
                                    <?php if ($product['is_new'] ?? false): ?>
                                        <div class="badge-img">
                                            <span>Yeni</span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($product['images']) && isset($product['images'][0]['image'])): ?>
                                        <img src="<?= esc('http://localhost/web_kafe_otomasyon/public/backend/assets/images/products/' . $product['images'][0]['image']) ?>"
                                             alt="<?= esc($product['title']) ?>" class="img-fluid img"
                                             style="height: unset;max-height: 150px;">
                                    <?php else: ?>
                                        <img src="<?= base_url('public/assets/images/placeholder.jpg') ?>"
                                             alt="No image" class="img-fluid img" style="height: unset;max-height: 150px">
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
                                    <span class="add-icon" data-product-id="<?= esc($product['id']) ?>">
                                        <?= getLucideIcon("plus","") ?>
                                    </span>

                                    <h6 class="content-color white-nowrap"><?= esc($category['title']) ?></h6>
                                    <h5 class="title-color fw-medium white-nowrap mt-1">
                                        <?= esc($product['title']) ?>
                                    </h5>

                                    <div class="bottom-content">
                                        <h5 class="price"><?= esc($product['price']) ?> ₺</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center no-products">
                        <i class="iconsax" data-icon="package-search"></i>
                        <?= getLucideIcon("package-search", "w-40 h-40") ?>
                        <h5 class="mt-3">Bu kategoride ürün bulunamadı</h5>
                        <p class="content-color mb-4">Başka bir kategori seçmeyi deneyebilirsiniz</p>
                        <a href="javascript:history.back()" class="btn btn-outline-primary">
                            <?= getLucideIcon("arrow-left", "me-2") ?> Geri Dön
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <div class="offcanvas offcanvas-bottom filter-offcanvas" tabindex="-1" id="sort" aria-modal="true" role="dialog">
        <div class="offcanvas-header">
            <h3>Sırala</h3>
            <button type="button" class="btn-close content-color" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form class="theme-form border-design" id="sortForm">
                <div class="form-check">
                    <label class="form-check-label" for="flexRadioDefault3">
                        Fiyat (En yüksekten başlayarak)
                    </label>
                    <input class="form-check-input ms-auto" type="radio" name="sort" id="flexRadioDefault3"
                           value="price_desc" <?= ($default_sort ?? 'price_desc') === 'price_desc' ? 'checked' : '' ?>>
                </div>
                <div class="form-check">
                    <label class="form-check-label" for="flexRadioDefault4">
                        Fiyat (En düşükten başlayarak)
                    </label>
                    <input class="form-check-input ms-auto" type="radio" name="sort" id="flexRadioDefault4"
                           value="price_asc" <?= ($default_sort ?? 'price_desc') === 'price_asc' ? 'checked' : '' ?>>
                </div>
            </form>
        </div>
    </div>

    <!-- Sipariş Notu Modalı -->
    <div class="modal fade" id="noteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content note-modal">
                <div class="modal-header">
                    <h5 class="modal-title content-color">Sipariş Notu Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="productTitle" class="fw-bold mb-2 content-color"></p>
                    <textarea class="form-control mb-2" id="productNote" placeholder="Bu ürün için özel notunuz..."></textarea>
                    <small class="content-color"><smal>Örneğin: Az tuzlu olsun, yanında ketçap istiyorum vb.</smal></small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Vazgeç</button>
                    <button type="button" class="btn btn-primary" id="confirmAddToCart">Sepete Ekle</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sepete Eklendi Modalı -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-4">
                    <?= getLucideIcon("check-circle","w-40 h-40 text-success mb-3")?>
                    <h5 class="mb-3">Ürün sepete eklendi!</h5>
                    <div class="d-flex gap-2 justify-content-center mt-3">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Sipariş Oluşturmaya Devam Et</button>
                        <a href="<?= base_url('sepet') ?>" class="btn btn-primary">Sepete Git</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Global değişkenler
            let currentProductId = null;
            const noteModal = new bootstrap.Modal(document.getElementById('noteModal'));
            const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));

            // Arama fonksiyonları
            const searchInput = document.getElementById('input_product_name');
            const searchResults = document.getElementById('searchResults');
            const resultsInner = searchResults.querySelector('.search-results-inner');
            const currentCategoryId = "<?= $category['id'] ?? '' ?>";
            const productsContainer = document.getElementById('productsContainer');

            // Sıralama formu
            const sortForm = document.getElementById('sortForm');
            const sortRadios = sortForm.querySelectorAll('input[type="radio"]');

            // Sıralama radyo butonlarına event ekle
            sortRadios.forEach(radio => {
                radio.addEventListener('change', function () {
                    if (this.checked) {
                        sortProducts(this.value);
                    }
                });
            });

            // Ürünleri sırala
            function sortProducts(sortType) {
                const products = Array.from(productsContainer.querySelectorAll('.col-6'));

                products.sort((a, b) => {
                    const priceA = parseFloat(a.querySelector('.price').textContent.replace(' ₺', '').trim());
                    const priceB = parseFloat(b.querySelector('.price').textContent.replace(' ₺', '').trim());

                    if (sortType === 'price_desc') {
                        return priceB - priceA;
                    } else if (sortType === 'price_asc') {
                        return priceA - priceB;
                    }
                    return 0;
                });

                // Sıralanmış ürünleri tekrar ekle
                products.forEach(product => {
                    productsContainer.appendChild(product);
                });
            }

            // Arama input'unda yazı yazıldığında
            searchInput.addEventListener('input', function () {
                const searchTerm = this.value.trim();

                if (searchTerm.length >= 2) {
                    fetch(`<?= base_url('_products/search') ?>?term=${encodeURIComponent(searchTerm)}&category=${currentCategoryId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success && data.results.length > 0) {
                                showSearchResults(data.results);
                            } else {
                                hideSearchResults();
                            }
                        })
                        .catch(error => {
                            console.error('Arama hatası:', error);
                            hideSearchResults();
                        });
                } else {
                    hideSearchResults();
                }
            });

            // Input dışında bir yere tıklandığında sonuçları gizle
            document.addEventListener('click', function (e) {
                if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                    hideSearchResults();
                }
            });

            // Arama sonuçlarını göster
            function showSearchResults(results) {
                resultsInner.innerHTML = '';

                results.forEach(product => {
                    const productElement = document.createElement('div');
                    productElement.className = 'search-result-item d-flex align-items-center p-2';
                    productElement.innerHTML = `
                <div class="flex-shrink-0 me-2">
                    <img src="${product.image || '<?= base_url('public/assets/images/placeholder.jpg') ?>'}"
                         alt="${product.title}" class="img-fluid rounded" style="width: 40px; height: 40px; object-fit: contain;">
                </div>
                <div class="flex-grow-1">
                    <h6 class="mb-0 title-color">${product.title}</h6>
                    <small class="content-color">${product.price} ₺</small>
                </div>
            `;
                    productElement.addEventListener('click', function () {
                        window.location.href = `<?= base_url('product') ?>/${product.id}`;
                    });
                    resultsInner.appendChild(productElement);
                });

                searchResults.style.display = 'block';
            }

            // Arama sonuçlarını gizle
            function hideSearchResults() {
                searchResults.style.display = 'none';
            }

            // Sepete ekleme butonlarına tıklama eventi ekle
            document.querySelectorAll('.add-icon').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    currentProductId = this.getAttribute('data-product-id');
                    const productTitle = this.closest('.product-content').querySelector('h5').textContent;

                    // Ürün adını modalda göster
                    document.getElementById('productTitle').textContent = productTitle;
                    document.getElementById('productNote').value = '';

                    // Not modalını göster
                    noteModal.show();
                });
            });

            // Not onay butonu
            document.getElementById('confirmAddToCart').addEventListener('click', function() {
                const note = document.getElementById('productNote').value;
                addToCartWithNote(currentProductId, note);
                noteModal.hide();
            });

            // Sepete ekleme fonksiyonu (not ile birlikte)
            function addToCartWithNote(productId, note) {
                fetch('<?= base_url('cart/add') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: 1,
                        note: note
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Başarılı modalını göster
                            cartModal.show();

                            // Sepet sayacını güncelle
                            updateCartCount(data.cart_count);
                        } else {
                            alert('Hata: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Bir hata oluştu!');
                    });
            }

            // Sepet sayacını güncelleme fonksiyonu
            function updateCartCount(count) {
                const cartCountElements = document.querySelectorAll('.cart-count');
                cartCountElements.forEach(element => {
                    element.textContent = count;
                });
            }
        });
    </script>
<?= $this->endSection() ?>