<!-- resources/views/admin/product.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin.css')
  <style>
    .text-blue {
      color: blue;
    }
  </style>
</head>
<body>
  <div class="container-scroller">
    @include('admin.sidebar')
    @include('admin.header')
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="container">
          <!-- Product Form -->
          <h2>Add New Product</h2>
          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              {{ session('success') }}
            </div>
          @endif
          <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="name">Product Name:</label>
              <input type="text" id="name" name="name" class="form-control custom-input text-blue" required>
            </div>
            <div class="form-group">
              <label for="description">Description:</label>
              <textarea id="description" name="description" class="form-control custom-input text-blue" rows="4"></textarea>
            </div>
            <div class="form-group">
              <label for="price">Price:</label>
              <input type="number" id="price" name="price" class="form-control text-blue" step="0.01" required>
            </div>
            <div class="form-group">
              <label for="stock_quantity">Stock Quantity:</label>
              <input type="number" id="stock_quantity" name="stock_quantity" class="form-control text-blue" required>
            </div>
            <div class="form-group">
              <label for="category_id">Category:</label>
              <select id="category_id" name="category_id" class="form-control">
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="image">Image:</label>
              <input type="file" id="image" name="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
          </form>

          <!-- Product List -->
          <h2 class="mt-5">Product List</h2>
          @if($products->isNotEmpty())
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Stock Quantity</th>
                  <th>Category</th>
                  <th>Image</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($products as $product)
                  <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->stock_quantity }}</td>
                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                    <td>
                      @if($product->image_path)
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="Product Image" width="100">
                      @else
                        No Image
                      @endif
                    </td>
                    <td>
                      <a href="{{ url('update_product', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                      <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @else
            <p>No products found.</p>
          @endif
        </div>
      </div>
    </div>
    @include('admin.script')
  </div>
</body>
</html>
