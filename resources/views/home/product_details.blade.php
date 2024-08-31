<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ecommerce website for BU Internship 2024">
    <meta name="keywords" content="Ecommerce, Bethlehem University, Frontend, Backend, Laravel, Internship">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Details</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

  
     <!-- Css Styles -->
     <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
     <link rel="stylesheet" href="{{ asset('home/css/font-awesome.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('home/css/elegant-icons.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('home/css/nice-select.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('home/css/jquery-ui.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('home/css/owl.carousel.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('home/css/slicknav.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('home/css/style.css') }}" type="text/css">


    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @include('home.header')
    @include('home.Humberger')

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product__details__pic">
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product__details__text">
                        <h3>{{ $product->name }}</h3>
                        <h4>${{ $product->price }}</h4>
                        <p>Product Description : {{ $product->description }}</p>
                        <form id="add-to-cart-form" action="{{ route('add_cart', $product->id) }}" method="POST">
                            @csrf
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="number" name="quantity" value="1" min="1">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="primary-btn">ADD TO CART</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    @include('home.footer')
    @include('home.script')

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('add-to-cart-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                const formData = new FormData(form);
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update cart UI dynamically
                        if (document.getElementById('cart-item-count')) {
                            document.getElementById('cart-item-count').textContent = data.totalItems;
                        }
                        if (document.getElementById('cart-total-price')) {
                            document.getElementById('cart-total-price').textContent = `$${data.totalPrice.toFixed(2)}`;
                        }

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
    </script>
</body>

</html>
