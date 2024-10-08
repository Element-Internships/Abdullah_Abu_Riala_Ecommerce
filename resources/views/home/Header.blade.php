<!-- Header Section Begin -->
@include('home.css')
@include('home.script')

<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> abodaburiala@gmail.com</li>
                            <li>Free Shipping for all Order of $99</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                        @if (Route::has('login'))
                        @auth
                            <!-- User Dropdown for Header -->
                            <div class="header__top__right__auth">
                                <a href="#" class="dropdown-toggle" id="headerUserDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user"></i> {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="headerUserDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();">Logout</a>
                                    <form id="logout-form-header" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="header__top__right__auth">
                                <a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a>
                            </div>
                            <div class="header__top__right__auth">
                                <a href="{{ route('register') }}"><i class="fa fa-user"></i> Register</a>
                            </div>
                        @endauth
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="{{ url('/') }}"><img src="img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('shop') }}">Shop</a></li>
                        <li><a href="#">My Account</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="{{ route('home.favorites') }}">My Favorites</a></li>
                                    <li><a href="{{ route('home.myorders') }}"">My Orders</a></li>
                                
                                </ul>
                            </li>
                            <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                <li><a href="{{ url('show_cart') }}">Shopping Cart</a></li>
                            <li><a href="{{ url('contact') }}">Contact us</a></li>

                                </ul>
                            </li>
                           
                            
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <li>
                            <a href="{{ url('show_cart') }}">
                                <i class="fa fa-shopping-bag"></i>
                                <span id="cart-item-count">{{ $totalItems }}</span>
                            </a>
                        </li>
                    </ul>
                    <div class="header__cart__price">item: <span id="cart-total-price">${{ number_format($totalPrice, 2) }}</span></div>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->
