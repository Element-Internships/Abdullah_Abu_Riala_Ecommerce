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
                                <li>
                                    <a href="#" class="add-to-cart" data-id="{{ $product->id }}">
                                        <i class="fa fa-shopping-cart"></i>
                                    </a>
                                    <form id="form-{{ $product->id }}" action="{{ url('add_cart', $product->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="{{ url('product_details', $product->id) }}">{{ $product->name }}</a></h6>
                            <h5>${{ $product->price }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Featured Section End -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.add-to-cart').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                var productId = this.getAttribute('data-id');
                var form = document.getElementById('form-' + productId);
                form.submit();
            });
        });
    });
</script>
