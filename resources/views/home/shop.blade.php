<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ecommerce website for BU Internship 2024">
    <meta name="keywords" content="Ecommerce, Bethlehem University, Frontend, Backend, Laravel, Internship">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ecommerce BU Internship</title>

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>

    <div id="preloder">
        <div class="loader"></div>
    </div>
    
    @include('home.header')
    @include('home.Humberger')

    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shop Page</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">Home</a>
                            <span>Shop Page</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <!-- Sidebar Begin -->
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <!-- Categories -->
                        <div class="sidebar__item">
                            <h4>Categories</h4>
                            <ul>
                                <li><a href="#" data-category-id="all" class="filter-category">All</a></li>
                                @foreach($categories as $category)
                                    <li>
                                        <a href="#" data-category-id="{{ $category->id }}" class="filter-category">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Price Range -->
                        <div class="sidebar__item">
                            <h4>Price Range</h4>
                            <div class="price-range-wrap">
                                <div id="price-range" class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="1" data-max="5000">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount" readonly>
                                        <input type="text" id="maxamount" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sidebar End -->

                <!-- Products Begin -->
                <div class="col-lg-9 col-md-7">
                    <div class="row" id="product-list">
                        @foreach($products as $product)
                            @php
                                // Create a string of category classes for this product
                                $categoryClass = $product->category ? Str::slug($product->category->name) : '';
                            @endphp

                            <div class="col-lg-4 col-md-6 mb-4 product-item {{ $categoryClass }}" data-category-id="{{ $product->category_id }}" data-price="{{ $product->price }}">
                                <div class="featured__item">
                                    <div class="featured__item__pic set-bg" data-setbg="{{ asset('storage/' . $product->image_path) }}">
                                        <ul class="featured__item__pic__hover">
                                            
                                        <!-- Favorite Button -->
                                <li>
                                    <a href="#" class="add-to-fav" data-id="{{ $product->id }}">
                                        <i class="fa fa-heart"></i>
                                    </a>
                                    <form id="fav-form-{{ $product->id }}" action="{{ url('add_fav', $product->id) }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                                
                                            <li>
                                                <a href="#" class="add-to-cart" data-id="{{ $product->id }}">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </a>
                                                <form id="form-{{ $product->id }}" action="{{ route('add_cart', $product->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    <input type="hidden" name="quantity" value="1">
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="featured__item__text">
                                        <h6><a href="{{ route('product_details', $product->id) }}">{{ $product->name }}</a></h6>
                                        <h5>${{ $product->price }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="product__pagination mt-4">
                        {{ $products->links('pagination.custom') }}
                    </div>
                </div>
                <!-- Products End -->
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    @include('home.footer')
    @include('home.script')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categoryLinks = document.querySelectorAll('.filter-category');
        const productItems = document.querySelectorAll('.product-item');

        // Initialize the price range slider
        const priceRange = document.getElementById('price-range');
        const minAmount = document.getElementById('minamount');
        const maxAmount = document.getElementById('maxamount');

        $(priceRange).slider({
            range: true,
            min: $(priceRange).data('min'),
            max: $(priceRange).data('max'),
            values: [$(priceRange).data('min'), $(priceRange).data('max')],
            slide: function (event, ui) {
                minAmount.value = `$${ui.values[0]}`;
                maxAmount.value = `$${ui.values[1]}`;
                filterProducts();
            }
        });

        // Initial display
        minAmount.value = `$${$(priceRange).slider('values', 0)}`;
        maxAmount.value = `$${$(priceRange).slider('values', 1)}`;

        function filterProducts() {
            const minPrice = $(priceRange).slider('values', 0);
            const maxPrice = $(priceRange).slider('values', 1);
            const categoryId = document.querySelector('.filter-category.active')?.getAttribute('data-category-id') || 'all';

            productItems.forEach(item => {
                const itemCategoryId = item.getAttribute('data-category-id');
                const itemPrice = parseFloat(item.getAttribute('data-price'));

                if (
                    (categoryId === 'all' || itemCategoryId === categoryId) &&
                    itemPrice >= minPrice &&
                    itemPrice <= maxPrice
                ) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        // Handle category filter
        categoryLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                categoryLinks.forEach(link => link.classList.remove('active'));
                this.classList.add('active');
                filterProducts();
            });
        });

        // Handle add to cart
        document.querySelectorAll('.add-to-cart').forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                var productId = this.getAttribute('data-id');
                var quantity = 1; // Default quantity

                fetch(`{{ url('add_cart') }}/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ quantity: quantity })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update cart UI dynamically
                        document.getElementById('cart-item-count').textContent = data.totalItems;
                        document.getElementById('cart-total-price').textContent = `$${data.totalPrice.toFixed(2)}`;
                        
                        // Show success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Added to Cart',
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                    } else {
                        // Show error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });

        // Handle add to favorites
        document.querySelectorAll('.add-to-fav').forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                var productId = this.getAttribute('data-id');

                fetch(`{{ url('add_fav') }}/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        icon: data.success ? (data.message === 'Product is already in your favorites.' ? 'info' : 'success') : 'warning',
                        title: data.success ? (data.message === 'Product is already in your favorites.' ? 'Already in Favorites' : 'Added to Favorites') : '',
                        text: data.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    });
</script>

</body>

</html>
