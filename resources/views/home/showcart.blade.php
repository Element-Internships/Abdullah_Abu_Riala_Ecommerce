<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ecommerce website for BU Internship 2024">
    <meta name="keywords" content="Ecommerce, Bethlehem University, Frontend, Backend, Laravel, Internship">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Shopping Cart</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    @include('home.css')

    <style>
        .page-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;
        }

        .cart-section {
            padding: 50px 0;
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
        }

        .cart-table th, .cart-table td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        .cart-table th {
            background-color: #f4f4f4;
        }

        .cart-table img {
            width: 100px;
            height: auto;
        }

        .cart-total {
            margin-top: 20px;
            text-align: right;
        }

        .cart-total h3 {
            font-size: 24px;
            margin: 0;
        }

        .btn-update {
            background-color: #5cb85c;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        .btn-remove {
            color: #d9534f;
            text-decoration: none;
            cursor: pointer;
        }

        .quantity {
            display: flex;
            align-items: center;
            gap: 5px; /* Add space between buttons and input */
        }

        .quantity button {
            background-color: #5bc0de;
            border: none;
            color: white;
            padding: 5px 10px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }

        .quantity button:disabled {
            background-color: #ddd;
            cursor: not-allowed;
        }

        .quantity-value {
            width: 40px;
            text-align: center;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <!-- Page Preloder -->
        <div id="preloder">
            <div class="loader"></div>
        </div>

        @include('home.header')
        @include('home.Humberger')

        @if(session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('message') }}
            </div>
        @endif
        <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
      <!-- Cart Section -->
<section class="cart-section content spad">
    <div class="container">
        <h2>YOUR CART</h2>

        @if ($cartItems->isEmpty())
        <h2>   IS EMPTY</h2>
        <br>
            <div class="row">
            <div class="col-lg-6">
                <div class="shoping__cart__btns">
                    <a href="{{ url('shop') }}" class="primary-btn cart-btn">GO SHOPPING</a>
                </div>
            </div>
        @else
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $item)
                        <tr>
                            <td><img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->product_tittle }}">
                            {{ $item->product_tittle }}</td>
                            <td>
                                <div class="quantity">
                                    <button class="btn-decrement" data-id="{{ $item->id }}">-</button>
                                    <input type="text" class="quantity-value" value="{{ $item->quantity }}" readonly>
                                    <button class="btn-increment" data-id="{{ $item->id }}">+</button>
                                </div>
                            </td>
                            <td>${{ number_format($item->price / $item->quantity, 2) }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td class="shoping__cart__item__close">
                                <a href="{{ route('cart.delete', $item->id) }}" class="btn-remove"><span class="icon_close"></span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="row">
            <div class="col-lg-6">
                <div class="shoping__cart__btns">
                    <a href="{{ url('shop') }}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout" style="margin-top:0px;">
                    <h5>Cart Total</h5>
                    <div class="cart-total">
                        <h3>Total: ${{ number_format($cartItems->sum('price'), 2) }}</h3>
                    </div>
                    <a href="{{ route('cash_order') }}" class="primary-btn">Proceed with Cash on Delivery</a>
                    <br>
                    <a href="{{ url('stripe') }}" class="primary-btn">Proceed with Card Payment</a>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

        <style>
            .checkout-options {
                margin-top: 30px;
                text-align: right;
            }

            .btn-checkout {
                display: inline-block;
                padding: 10px 20px;
                margin: 0 10px;
                color: white;
                text-decoration: none;
                border-radius: 4px;
                font-size: 16px;
                cursor: pointer;
            }

            .btn-cash {
                background-color: #5bc0de;
            }

            .btn-card {
                background-color: #d9534f;
            }

            .btn-checkout:hover {
                opacity: 0.8;
            }
            
    .quantity {
        display: flex;
        align-items: center;
        gap: 5px; /* Add space between buttons and input */
    }

    .quantity button {
        background-color: #5bc0de;
        border: none;
        color: white;
        padding: 5px 10px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 4px;
    }

    .quantity button:disabled {
        background-color: #ddd;
        cursor: not-allowed;
    }

    .quantity-value {
        width: 40px;
        text-align: center;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
    }

        </style>

        @include('home.footer')
    </div>

    @include('home.script')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // Handle cart item quantity update with + and - buttons
    $('.cart-table').on('click', '.btn-increment, .btn-decrement', function(event) {
        event.preventDefault();
        var button = $(this);
        var cartItemId = button.data('id');
        var quantityElement = button.siblings('.quantity-value');
        var currentQuantity = parseInt(quantityElement.val());
        var newQuantity = button.hasClass('btn-increment') ? currentQuantity + 1 : currentQuantity - 1;

        if (newQuantity < 1) return; // Prevent quantity from being less than 1

        $.ajax({
            url: '{{ route('cart.update', '') }}/' + cartItemId,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                quantity: newQuantity
            },
            success: function(response) {
                quantityElement.val(newQuantity);
                // Update the total price in the cart
                $('.cart-total h3').text('Total: $' + response.totalPrice.toFixed(2));

                // Update cart icon count and price
                $('#cart-item-count').text(response.totalItems);
                $('#cart-total-price').text('$' + response.totalPrice.toFixed(2));

                Swal.fire({
                    icon: 'success',
                    title: 'Quantity updated',
                    text: 'The quantity has been updated successfully.'
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while updating the quantity.'
                });
            }
        });
    });
});
</script>


</body>
</html>
