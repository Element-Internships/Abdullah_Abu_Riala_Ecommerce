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
        }

        .btn-remove:hover {
            text-decoration: underline;
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

        <!-- Cart Section -->
        <section class="cart-section content spad">
            <div class="container">
                <h2>Your Cart</h2>

                @if ($cartItems->isEmpty())
                    <p>Your cart is empty.</p>
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
                                        <a href="{{ route('cart.delete', $item->id) }}" class="btn-remove" onclick="return confirm('Are you sure you want to remove this item from the cart?')">Remove</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="cart-total">
                        <h3>Total: ${{ number_format($cartItems->sum('price'), 2) }}</h3>
                    </div>
                @endif
            </div>
        </section>

        @include('home.footer')
    </div>

    @include('home.script')
</body>

</html>
