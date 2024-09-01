<!-- script.blade.php -->
<script src="{{ asset('home/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('home/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('home/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('home/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('home/js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('home/js/mixitup.min.js') }}"></script>
<script src="{{ asset('home/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('home/js/main.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- Js Plugins -->
 
<script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>

   
    <script>
    var availableTags = [];

$.ajax({
    method: "GET",
    url: "/product-list",
    success: function (response) {
        availableTags = response.map(function(product) {
            return product.name;
        });
        
        startAutoComplete(response); // Pass the full response to get product IDs
    },
    error: function(xhr, status, error) {
        console.error("Error:", error);
    }
});

function startAutoComplete(products) {
    $("#search_product").autocomplete({
        source: availableTags,
        select: function (event, ui) {
            // Find the product ID from the selected product name
            var product = products.find(p => p.name === ui.item.value);
            if (product) {
                window.location.href = "{{ url('product_details') }}/" + product.id;
            }
        }
    });
}

$("#search-form").submit(function(event) {
    event.preventDefault(); // Prevent the default form submission
    var query = $("#search_product").val();
    var product = availableTags.find(p => p.name === query);
    if (product) {
        window.location.href = "{{ url('product_details') }}/" + product.id;
    }
});

</script>

