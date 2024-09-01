<!-- Hero Section Begin -->
@include('home.css')
@include('home.script')


<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All Categories</span>
                    </div>
                    <ul>
                        @foreach($categories as $category)
                            <li><a href="#">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form id="search-form">
                            <input type="search" id="search_product" placeholder="What do you need?" autocomplete="off">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+65 11.188.888</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
                <div class="hero__item set-bg" data-setbg="img/hero/banner.jpg">
                    <div class="hero__text">
                        <span>High Quality</span>
                        <h2>All PRODUCTS <br />100% Original</h2>
                        <p>Free Pickup and Delivery Available</p>
                        <a href="{{ route('shop') }}" class="primary-btn">SHOP NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Add some CSS for the dropdown -->
<style>
    .header__menu__dropdown {
        position: absolute;
        background-color: white;
        border: 1px solid #ddd;
        z-index: 1000;
        width: 100%;
        max-height: 200px; /* Limit height of dropdown */
        overflow-y: auto; /* Scroll if content is too long */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Optional shadow for dropdown */
    }
    .header__menu__dropdown a {
        display: block;
        padding: 10px;
        color: #333;
        text-decoration: none;
    }
    .header__menu__dropdown a:hover {
        background-color: #f0f0f0;
    }
</style>

