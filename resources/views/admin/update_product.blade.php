<!-- resources/views/admin/product.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
  @include('admin.css')
</head>
<body>
  <div class="container-scroller">
    @include('admin.sidebar')
    @include('admin.header')
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="container">
          <!-- Product Form -->
          <h2>Edit Product</h2>
          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              {{ session('success') }}
            </div>
          @endif
          <form action="{{ route('update_product_confirm', $product->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
              <label for="name">Product Name:</label>
              <input type="text" id="name" name="name" class="form-control" style="color: red;" required value="{{$product->name}}">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" class="form-control" style="color: red;" required rows="4">{{ $product->description }}</textarea>
            </div>

            <div class="form-group">
              <label for="price">Price:</label>
              <input type="number" id="price" name="price" class="form-control" style="color: red;" step="0.01" required value="{{$product->price}}">
            </div>
            <div class="form-group">
              <label for="stock_quantity">Stock Quantity:</label>
              <input type="number" id="stock_quantity" name="stock_quantity" class="form-control" style="color: red;" required value="{{$product->stock_quantity}}">
            </div>

           <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" class="form-control" style="color: red;" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

            <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control">
            @if($product->image_path)
                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" width="100">
            @endif
        </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
          </form>

        
    @include('admin.script')
  </div>
</body>
</html>
