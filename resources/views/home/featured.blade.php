  <!-- Featured Section Begin -->
  <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Products We Loved!!</h2>
                    </div>
                        <div class="featured__controls">
                            <ul>
                                <li class="active" data-filter="*">All</li>
                                @foreach($categories as $category)
                                    <li data-filter=".{{ Str::slug($category->name) }}">{{ $category->name }}</li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
            </div>

            <div class="row featured__filter">
    @foreach($product as $product)
        @php
            // Create a string of category classes for this product
            $categoryClass = $product->category ? Str::slug($product->category->name) : '';
        @endphp

        <div class="col-lg-3 col-md-4 col-sm-6 mix {{ $categoryClass }}">
            <div class="featured__item">
                <div class="featured__item__pic set-bg" data-setbg="{{ asset('storage/' . $product->image_path) }}">
                    <ul class="featured__item__pic__hover">
                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                </div>
                <div class="featured__item__text">
                    <h6><a href="#">{{ $product->name }}</a></h6>
                    <h5>${{ $product->price }}</h5>
                </div>
            </div>
        </div>
    @endforeach
</div>


        </div>
    </section>
    <!-- Featured Section End -->