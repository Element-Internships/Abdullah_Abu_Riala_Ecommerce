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
                        <div class="featured__item__pic set-bg" data-setbg="{{ asset('storage/' . $product->image_path) }}" style="background-size: cover; background-position: center; height: 200px;">
                            <ul class="featured__item__pic__hover">
                                <!-- Favorite Button -->
                                <li>
                                    <a href="#" class="add-to-fav" data-id="{{ $product->id }}">
                                        <i class="fa fa-heart"></i>
                                    </a>
                                    <form id="fav-form-{{ $product->id }}" action="{{ url('add_fav', $product->id) }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>

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

<!-- SweetAlert2 and JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.add-to-cart').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                var productId = this.getAttribute('data-id');
                var quantity = 1; // Default quantity

                fetch(`{{ url('add_cart') }}/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ quantity: quantity })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('cart-item-count').textContent = data.totalItems;
                        document.getElementById('cart-total-price').textContent = `$${data.totalPrice.toFixed(2)}`;
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Added to Cart',
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });

        document.querySelectorAll('.add-to-fav').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                var productId = this.getAttribute('data-id');

                fetch(`{{ url('add_fav') }}/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        icon: data.success ? (data.message === 'Product is already in your favorites.' ? 'info' : 'success') : 'warning',
                        title: data.success ? (data.message === 'Product is already in your favorites.' ? 'Already in Favorites' : 'Added to Favorites') : '',
                        text: data.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    });
</script>
