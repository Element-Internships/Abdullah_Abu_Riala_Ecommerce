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
    
   <!-- Header Section Begin -->
@include('home.css')
@include('home.script')

    @include('home.header')
    @include('home.Humberger')
    
    <section class="breadcrumb-section set-bg" data-setbg="imgg/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Login</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">Home</a>
                            <span>Login</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Form Begin -->
<div class="contact-form spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact__form__title">
                    <h2>Login to your Account</h2>
                </div>
            </div>
            <div class="col-lg-8 offset-2">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="email">Email address</label>
                        <input type="email" id="email" class="form-control" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" id="password" class="form-control" name="password" required autocomplete="current-password" />
                    </div>
                    <div class="form-outline mb-4">
                        <label for="remember_me" class="form-label">
                            <input type="checkbox" id="remember_me" name="remember" class="me-2" />
                            Remember me
                        </label>
                    </div>
                    <div class="form-outline mb-4 text-center">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-dark" style="text-decoration: underline;">
                                Forgot your password?
                            </a>
                        @endif
                    </div>
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">
                        Sign in
                    </button>
                </form>
                
                <div class="col-md-12 mb-4 text-center">
                    <a href="{{ route('register') }}" class="text-dark" style="text-decoration: underline;">
                        If you don't have an account, click here to create a new one.
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Form End -->




    @include('home.footer')
    @include('home.script')


</body>

</html>