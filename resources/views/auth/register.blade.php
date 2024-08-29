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
    
    @include('home.css')
    @include('home.script')
    @include('home.header')
    @include('home.Humberger')
    
    
    
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Register</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">Home</a>
                            <span>Register</span>
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
                        <h2>Create New Account</h2>
                    </div>
                </div>
                <div class="col-lg-8 offset-2">
                    <!-- Start of Laravel Blade Form -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="name">Full Name <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control form-control-lg" :value="old('name')" required autofocus autocomplete="name" />
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" class="form-control form-control-lg" :value="old('email')" required autocomplete="username" />
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="phone">Phone <span class="text-danger">*</span></label>
                                <input type="number" id="phone" name="phone" class="form-control form-control-lg" :value="old('phone')" required autocomplete="phone" />
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="address">Address <span class="text-danger">*</span></label>
                                <input type="text" id="address" name="address" class="form-control form-control-lg" :value="old('address')" required autocomplete="address" />
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" id="password" name="password" class="form-control form-control-lg" required autocomplete="new-password" />
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-lg" required autocomplete="new-password" />
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="d-flex justify-content-end pt-3">
                                    <button type="reset" class="btn btn-light btn-lg">Reset all</button>
                                    <button type="submit" class="btn btn-primary btn-lg ml-2">Register</button>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4 text-center">
                                <a href="{{ route('login') }}" class="text-dark" style="text-decoration: underline;">If you have an account, click here to login.</a>
                            </div>
                        </div>
                    </form>
                    <!-- End of Laravel Blade Form -->
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Form End -->

    

    @include('home.footer')
    @include('home.script')

</body>

</html>