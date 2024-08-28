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

        .btn-remove:hover {
            text-decoration: underline;
        }

        .quantity {
            display: inline-block;
            width: 80px;
        }

        .pro-qty input {
            width: 100%;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-align: center;
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
        <h2>Your Cart</h2>

        @if ($cartItems->isEmpty())
            <p>Your cart is empty :(</p>
        @else
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product Image</th>
                        <th>Product Title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $item)
                        <tr>
                            <td><img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->product_tittle }}"></td>
                            <td>{{ $item->product_tittle }}</td>
                            <td>
                            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                            @csrf
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" required>
                                            <button type="submit" class="btn-update">Update</button>
                                        </form>
                                    </td>
                                    <td>${{ number_format($item->price / $item->quantity, 2) }}</td>
                                    <td>${{ number_format($item->price, 2) }}</td>
                            <td>
                                <a href="{{ route('cart.delete', $item->id) }}" class="btn-remove">Remove</a>
                                </form> <!-- Move the form closing tag here -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="cart-total">
                <h3>Total: ${{ number_format($cartItems->sum('price'), 2) }}</h3>
            </div>

            <!-- Checkout Options -->
            <div class="checkout-options">
                <a href="{{ route('cash_order') }}" class="btn-checkout btn-cash">Proceed with Cash on Delivery</a>
                <a href="{{ url('checkout') }}" class="btn-checkout btn-card">Proceed with Card Payment</a>
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
        </style>

        @include('home.footer')
    </div>

    @include('home.script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle cart item quantity update
    $('.cart-table').on('submit', 'form', function(event) {
        event.preventDefault();
        var form = $(this);
        var actionUrl = form.attr('action');
        var formData = form.serialize();

        $.ajax({
            url: actionUrl,
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    // Update cart items and total price
                    form.closest('tr').find('td').eq(4).text('$' + (response.totalPrice / response.totalItems).toFixed(2));
                    $('.cart-total h3').text('Total: $' + response.totalPrice.toFixed(2));

                    // Update cart UI dynamically
                    if (document.getElementById('cart-item-count')) {
                        document.getElementById('cart-item-count').textContent = response.totalItems;
                    }
                    if (document.getElementById('cart-total-price')) {
                        document.getElementById('cart-total-price').textContent = `$${response.totalPrice.toFixed(2)}`;
                    }

                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            }
        });
    });

    // Handle cart item removal with SweetAlert confirmation
    $('.cart-table').on('click', '.btn-remove', function(event) {
        event.preventDefault();
        var link = $(this);
        var actionUrl = link.attr('href');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d9534f',
            cancelButtonColor: '#5bc0de',
            confirmButtonText: 'Yes, remove it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: actionUrl,
                    method: 'GET',
                    success: function(response) {
                        if (response.success) {
                            // Remove the row from the table
                            link.closest('tr').remove();
                            $('.cart-total h3').text('Total: $' + response.totalPrice.toFixed(2));

                            // Update cart UI dynamically
                            if (document.getElementById('cart-item-count')) {
                                document.getElementById('cart-item-count').textContent = response.totalItems;
                            }
                            if (document.getElementById('cart-total-price')) {
                                document.getElementById('cart-total-price').textContent = `$${response.totalPrice.toFixed(2)}`;
                            }

                            // Show success message
                            Swal.fire({
                                icon: 'success',
                                title: 'Removed',
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false
                            });
                        }
                    }
                });
            }
        });
    });
});
</script>

</body>

</html>
