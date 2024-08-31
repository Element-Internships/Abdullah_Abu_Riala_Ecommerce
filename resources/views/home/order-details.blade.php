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

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
     <link rel="stylesheet" href="{{ asset('home/css/font-awesome.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('home/css/elegant-icons.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('home/css/nice-select.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('home/css/jquery-ui.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('home/css/owl.carousel.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('home/css/slicknav.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('home/css/style.css') }}" type="text/css">

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
                        <h2>Order #2</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>View Order Details</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shoping-cart spad">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Order Details</h2>
        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Order Date:</strong> {{ $order->created_at->format('Y-m-d') }}</p>
                <p><strong>Status:</strong> <span class="badge badge-info">{{ $order->delivery_status }}</span></p>
                <p><strong>Total Price:</strong> ${{ $order->price }}</p>
            </div>
        </div>
    
        <div class="card mb-4">
            <div class="card-header">
                <h5>Shipping Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Recipient:</strong> {{ $order->name }}</p>
                <p><strong>Address:</strong> {{ $order->address }}</p>
                <p><strong>Phone:</strong> {{ $order->phone }}</p>
            </div>
        </div>
    
        <div class="card mb-4">
            <div class="card-header">
                <h5>Products Ordered</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $order->product_title }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>${{ $order->price / $order->quantity }}</td>
                            <td>${{ $order->price }}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-right">Total:</th>
                            <th>${{ $order->price }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    
        <div class="text-center">
            <a href="{{ route('home.myorders') }}" class="btn btn-primary">Back to Orders</a>
        </div>
    </div>
</section>


   
    @include('home.footer')
    @include('home.script')
    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>



</body>

</html>