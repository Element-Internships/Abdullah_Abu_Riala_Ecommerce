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
    <style>
        .shoping__cart__item img {
            width: 100px; /* Adjust width as needed */
            height: auto; /* Maintain aspect ratio */
            object-fit: cover; /* Ensure image covers the space */
            border-radius: 8px; /* Optional: add rounded corners */
            margin-right: 15px; /* Space between image and text */
        }
    </style>
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
                        <h2>My Favorites</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">Home</a>
                            <span>My Favorites</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Favorites Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products I Liked</th>
                                    <th>Price</th>
                                    <th width="50">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($favorites as $favorite)
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img src="{{ asset('storage/' . $favorite->product->image_path) }}" alt="{{ $favorite->product->name }}">
                                            <h5>{{ $favorite->product->name }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            ${{ number_format($favorite->product->price, 2) }}
                                        </td>
                                        <td class="shoping__cart__item__close text-center">
                                            <a href="{{ route('remove_fav', ['id' => $favorite->product->id]) }}" class="remove-fav">
                                                <span class="icon_close"></span>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No favorites found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('home.footer')
    @include('home.script')

</body>

</html>
