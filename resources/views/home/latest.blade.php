<!-- Latest Product Section Begin -->
<section class="latest-product spad mb-5 pb-5">
    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <div class="latest-product__text">
                    <h4>Latest Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        @foreach($latestProducts->chunk(3) as $chunk) <!-- Chunk products into groups of 3 -->
                            <div class="latest-prdouct__slider__item">
                                @foreach($chunk as $product)
                                    <a href="{{url('product_details',$product->id)}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $product->name }}</h6>
                                            <span>${{ $product->price }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest Product Section End -->
