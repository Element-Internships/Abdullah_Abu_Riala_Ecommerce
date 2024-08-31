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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        <h2>My Orders</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">Home</a>
                            <span>My Orders</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shoping-cart spad">
        <div class="container mt-5">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Order ID</th>
                            <th>Order Date</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('Y-m-d') }}</td>
                            <td>${{ $order->price }}</td>
                            <td>
                            <span class="badge" style="
                                background-color: {{ $order->delivery_status == 'CANCELED' ? 'red' : ($order->delivery_status == 'Delivered' ? 'green' : ($order->delivery_status == 'Processing' ? 'blue' : 'info')) }};
                                color: white;">
                                {{ $order->delivery_status }}
                            </span>
                        </td>

                            
                            <td>
                            <a href="{{ route('home.order-details', $order->id) }}" class="btn btn-sm btn-primary">View</a>

                                @if ($order->delivery_status == 'Processing')
                                    <form id="cancel-form-{{ $order->id }}" action="{{ route('order.cancel', $order->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmCancel({{ $order->id }})">Cancel</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @include('home.footer')
    @include('home.script')

    <script>
        function confirmCancel(orderId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cancel-form-' + orderId).submit();
                }
            });
        }
    </script>

</body>

</html>
