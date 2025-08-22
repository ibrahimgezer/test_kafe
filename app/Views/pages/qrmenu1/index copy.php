<?= $this->extend('layouts/layout'); ?>

<?= $this->section('content') ?>


    <!-- Kategori Bölümü -->
    <section class="pt-2">
        <div class="custom-container">
            <h4 class="mb-3 fw-semibold">Kategoriler</h4>
            <ul class="categories-slider custom-scrollbar">
                <li>
                    <a href="#hot-drinks" class="category-box">
                        <div class="category-box-img">
                            <div class="category-icon">☕</div>
                        </div>
                        <h5>Sıcak İçecekler</h5>
                    </a>
                </li>
                <li>
                    <a href="#cold-drinks" class="category-box">
                        <div class="category-box-img">
                            <div class="category-icon">🥤</div>
                        </div>
                        <h5>Soğuk İçecekler</h5>
                    </a>
                </li>
                <li>
                    <a href="#desserts" class="category-box">
                        <div class="category-box-img">
                            <div class="category-icon">🍰</div>
                        </div>
                        <h5>Tatlılar</h5>
                    </a>
                </li>
                <li>
                    <a href="#snacks" class="category-box">
                        <div class="category-box-img">
                            <div class="category-icon">🥨</div>
                        </div>
                        <h5>Atıştırmalıklar</h5>
                    </a>
                </li>
                <li>
                    <a href="#breakfast" class="category-box">
                        <div class="category-box-img">
                            <div class="category-icon">🍳</div>
                        </div>
                        <h5>Kahvaltı</h5>
                    </a>
                </li>
                <li>
                    <a href="#lunch" class="category-box">
                        <div class="category-box-img">
                            <div class="category-icon">🍽️</div>
                        </div>
                        <h5>Öğle Yemeği</h5>
                    </a>
                </li>
            </ul>
        </div>
    </section>

    <!-- Öne Çıkan Ürünler -->
    <section class="mt-4">
        <div class="custom-container">
            <div class="title">
                <div class="d-flex align-items-center gap-2">
                    <h3>🔥 Öne Çıkan Ürünler</h3>
                    <div class="badge bg-danger">Yeni</div>
                </div>
                <a href="#all-products" class="see-all">Tümünü Gör</a>
            </div>

            <div class="row g-3">
                <div class="col-6">
                    <div class="product-box">
                        <div class="product-img">
                            <div class="badge-img">
                                <span>Popüler</span>
                            </div>
                            <div class="product-placeholder">☕</div>
                        </div>
                        <div class="product-content">
                            <a href="#" class="add-icon" onclick="addToCart(1)">
                                <i class="iconsax" data-icon="add"></i>
                            </a>
                            <h6 class="content-color white-nowrap">İçecek</h6>
                            <a href="#">
                                <h5 class="title-color fw-medium white-nowrap mt-1">Türk Kahvesi</h5>
                            </a>
                            <div class="bottom-content">
                                <h5 class="price">₺25</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="product-box">
                        <div class="product-img">
                            <div class="product-placeholder">🍰</div>
                        </div>
                        <div class="product-content">
                            <a href="#" class="add-icon" onclick="addToCart(2)">
                                <i class="iconsax" data-icon="add"></i>
                            </a>
                            <h6 class="content-color white-nowrap">Tatlı</h6>
                            <a href="#">
                                <h5 class="title-color fw-medium white-nowrap mt-1">Cheesecake</h5>
                            </a>
                            <div class="bottom-content">
                                <h5 class="price">₺35</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="product-box">
                        <div class="product-img">
                            <div class="badge-img">
                                <span>Yeni</span>
                            </div>
                            <div class="product-placeholder">🥤</div>
                        </div>
                        <div class="product-content">
                            <a href="#" class="add-icon" onclick="addToCart(3)">
                                <i class="iconsax" data-icon="add"></i>
                            </a>
                            <h6 class="content-color white-nowrap">İçecek</h6>
                            <a href="#">
                                <h5 class="title-color fw-medium white-nowrap mt-1">Latte</h5>
                            </a>
                            <div class="bottom-content">
                                <h5 class="price">₺30</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="product-box">
                        <div class="product-img">
                            <div class="product-placeholder">🥨</div>
                        </div>
                        <div class="product-content">
                            <a href="#" class="add-icon" onclick="addToCart(4)">
                                <i class="iconsax" data-icon="add"></i>
                            </a>
                            <h6 class="content-color white-nowrap">Atıştırmalık</h6>
                            <a href="#">
                                <h5 class="title-color fw-medium white-nowrap mt-1">Simit</h5>
                            </a>
                            <div class="bottom-content">
                                <h5 class="price">₺15</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sıcak İçecekler -->
    <section id="hot-drinks" class="mt-4">
        <div class="custom-container">
            <div class="title">
                <h3>☕ Sıcak İçecekler</h3>
                <a href="#" class="see-all">Tümünü Gör</a>
            </div>
            <div class="row gy-3 gx-0">
                <div class="col-12">
                    <div class="product-box vertical-product">
                        <div class="product-img">
                            <div class="product-placeholder">☕</div>
                        </div>
                        <div class="product-content">
                            <h6 class="content-color">Kahve</h6>
                            <a href="#" class="product-top">
                                <h5 class="title-color white-nowrap">Türk Kahvesi</h5>
                            </a>
                            <div class="bottom-content">
                                <h5 class="price">₺25</h5>
                            </div>
                        </div>
                        <a href="#" class="add-icon" onclick="addToCart(5)">
                            <i class="iconsax" data-icon="add"></i>
                        </a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="product-box vertical-product">
                        <div class="product-img">
                            <div class="product-placeholder">☕</div>
                        </div>
                        <div class="product-content">
                            <h6 class="content-color">Kahve</h6>
                            <a href="#" class="product-top">
                                <h5 class="title-color white-nowrap">Espresso</h5>
                            </a>
                            <div class="bottom-content">
                                <h5 class="price">₺20</h5>
                            </div>
                        </div>
                        <a href="#" class="add-icon" onclick="addToCart(6)">
                            <i class="iconsax" data-icon="add"></i>
                        </a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="product-box vertical-product">
                        <div class="product-img">
                            <div class="product-placeholder">☕</div>
                        </div>
                        <div class="product-content">
                            <h6 class="content-color">Kahve</h6>
                            <a href="#" class="product-top">
                                <h5 class="title-color white-nowrap">Cappuccino</h5>
                            </a>
                            <div class="bottom-content">
                                <h5 class="price">₺28</h5>
                            </div>
                        </div>
                        <a href="#" class="add-icon" onclick="addToCart(7)">
                            <i class="iconsax" data-icon="add"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Soğuk İçecekler -->
    <section id="cold-drinks" class="mt-4">
        <div class="custom-container">
            <div class="title">
                <h3>🥤 Soğuk İçecekler</h3>
                <a href="#" class="see-all">Tümünü Gör</a>
            </div>
            <div class="row g-3">
                <div class="col-6">
                    <div class="product-box">
                        <div class="product-img">
                            <div class="product-placeholder">🥤</div>
                        </div>
                        <div class="product-content">
                            <a href="#" class="add-icon" onclick="addToCart(8)">
                                <i class="iconsax" data-icon="add"></i>
                            </a>
                            <h6 class="content-color white-nowrap">İçecek</h6>
                            <a href="#">
                                <h5 class="title-color fw-medium white-nowrap mt-1">Buzlu Latte</h5>
                            </a>
                            <div class="bottom-content">
                                <h5 class="price">₺32</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="product-box">
                        <div class="product-img">
                            <div class="product-placeholder">🥤</div>
                        </div>
                        <div class="product-content">
                            <a href="#" class="add-icon" onclick="addToCart(9)">
                                <i class="iconsax" data-icon="add"></i>
                            </a>
                            <h6 class="content-color white-nowrap">İçecek</h6>
                            <a href="#">
                                <h5 class="title-color fw-medium white-nowrap mt-1">Smoothie</h5>
                            </a>
                            <div class="bottom-content">
                                <h5 class="price">₺35</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tatlılar -->
    <section id="desserts" class="mt-4">
        <div class="custom-container">
            <div class="title">
                <h3>🍰 Tatlılar</h3>
                <a href="#" class="see-all">Tümünü Gör</a>
            </div>
            <div class="row g-3">
                <div class="col-6">
                    <div class="product-box">
                        <div class="product-img">
                            <div class="badge-img">
                                <span>Popüler</span>
                            </div>
                            <div class="product-placeholder">🍰</div>
                        </div>
                        <div class="product-content">
                            <a href="#" class="add-icon" onclick="addToCart(10)">
                                <i class="iconsax" data-icon="add"></i>
                            </a>
                            <h6 class="content-color white-nowrap">Tatlı</h6>
                            <a href="#">
                                <h5 class="title-color fw-medium white-nowrap mt-1">Cheesecake</h5>
                            </a>
                            <div class="bottom-content">
                                <h5 class="price">₺35</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="product-box">
                        <div class="product-img">
                            <div class="product-placeholder">🍰</div>
                        </div>
                        <div class="product-content">
                            <a href="#" class="add-icon" onclick="addToCart(11)">
                                <i class="iconsax" data-icon="add"></i>
                            </a>
                            <h6 class="content-color white-nowrap">Tatlı</h6>
                            <a href="#">
                                <h5 class="title-color fw-medium white-nowrap mt-1">Tiramisu</h5>
                            </a>
                            <div class="bottom-content">
                                <h5 class="price">₺40</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sepet Özeti -->
    <section class="mt-4 mb-5">
        <div class="custom-container">
            <div class="card bg-light">
                <div class="card-body">
                    <h5 class="card-title">🛒 Sepetiniz</h5>
                    <div id="cart-items">
                        <p class="text-muted">Henüz ürün eklenmedi</p>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" onclick="viewCart()">
                            Sepeti Görüntüle
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .category-icon {
            font-size: 2rem;
            text-align: center;
            padding: 1rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 50%;
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }
        
        .product-placeholder {
            font-size: 3rem;
            text-align: center;
            padding: 2rem;
            background: #f8f9fa;
            border-radius: 10px;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .text-primary {
            color: #667eea !important;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
        }
    </style>

    <script>
        let cart = [];
        
        function addToCart(productId) {
            const products = {
                1: { name: 'Türk Kahvesi', price: 25, category: 'Sıcak İçecek' },
                2: { name: 'Cheesecake', price: 35, category: 'Tatlı' },
                3: { name: 'Latte', price: 30, category: 'Sıcak İçecek' },
                4: { name: 'Simit', price: 15, category: 'Atıştırmalık' },
                5: { name: 'Türk Kahvesi', price: 25, category: 'Sıcak İçecek' },
                6: { name: 'Espresso', price: 20, category: 'Sıcak İçecek' },
                7: { name: 'Cappuccino', price: 28, category: 'Sıcak İçecek' },
                8: { name: 'Buzlu Latte', price: 32, category: 'Soğuk İçecek' },
                9: { name: 'Smoothie', price: 35, category: 'Soğuk İçecek' },
                10: { name: 'Cheesecake', price: 35, category: 'Tatlı' },
                11: { name: 'Tiramisu', price: 40, category: 'Tatlı' }
            };
            
            const product = products[productId];
            if (product) {
                cart.push(product);
                updateCartDisplay();
                showNotification(`${product.name} sepete eklendi!`);
            }
        }
        
        function updateCartDisplay() {
            const cartContainer = document.getElementById('cart-items');
            if (cart.length === 0) {
                cartContainer.innerHTML = '<p class="text-muted">Henüz ürün eklenmedi</p>';
                return;
            }
            
            const total = cart.reduce((sum, item) => sum + item.price, 0);
            cartContainer.innerHTML = `
                <div class="d-flex justify-content-between mb-2">
                    <span>Toplam Ürün:</span>
                    <span>${cart.length}</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <strong>Toplam Tutar:</strong>
                    <strong>₺${total}</strong>
                </div>
            `;
        }
        
        function showNotification(message) {
            // Basit bildirim gösterimi
            const notification = document.createElement('div');
            notification.className = 'alert alert-success position-fixed';
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 250px;';
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
        
        function viewCart() {
            if (cart.length === 0) {
                alert('Sepetiniz boş!');
                return;
            }
            
            const total = cart.reduce((sum, item) => sum + item.price, 0);
            const cartDetails = cart.map(item => `${item.name} - ₺${item.price}`).join('\n');
            
            alert(`Sepet Detayları:\n\n${cartDetails}\n\nToplam: ₺${total}`);
        }
    </script>

<?= $this->endSection() ?>