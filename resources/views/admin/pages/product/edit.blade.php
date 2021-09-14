@extends('admin.layouts.master')

@section('admin_content')
<div class="row">
	<div class="col-md-8 grid-margin stretch-card">
    	<div class="card">
	      <div class="card-body">
	        <h3 class="card-title">Edit Product</h3>

	        <!-- Error show -->
	        @if ($errors->any())
			    <div class="alert alert-danger alert-dismissible fade show">
			    	<button type="button" class="close" data-dismiss="alert">&times;</button>
				  	<ul>
			            @foreach ($errors->all() as $error)
			                <p>{{ $error }}</p>
			            @endforeach
			        </ul>
				</div>
			@endif

	        <form action="{{ route('admin.product.update', $product->id) }}" method="post" class="forms-sample" enctype="multipart/form-data" file="true">
	        	@csrf

	          <div class="form-group">
	            <label for="title">Title</label>
	            <input type="text" class="form-control" name="title" id="title" value="{{ $product->title }}">
	          </div>

	          <div class="form-group">
	            <label for="desc">Description</label>
	            <textarea class="form-control" name="desc" id="desc" rows="10">{{ $product->description }}</textarea>
	          </div>

	          <div class="form-group">
	            <label for="quantity">Quantity</label>
	            <input type="number" class="form-control" name="quantity" id="quantity" value="{{ $product->quantity }}">
	          </div>

	          <div class="form-group">
	            <label for="price">Price</label>
	            <input type="number" class="form-control" name="price" id="price" value="{{ $product->pricee }}">
	          </div>

	          <div class="form-group">
	            <label for="brand">Brand</label>
	            <select class="form-control" name="brand_id" id="brand">
	            	<option value="">— Select Brand —</option>
	            	@foreach(App\Models\Brand::orderBy('title', 'asc')->get() as $brand)
	            		<option value="{{ $brand->id }}" {{ $brand->id == $product->brand->id ? 'selected' : '' }}>{{ $brand->title }}</option>
	            	@endforeach
	            </select>
	          </div>

	          <div class="form-group">
	            <label for="category">Category</label>
	            <select class="form-control" name="category_id" id="category">
	            	<option value="">— Select Category —</option>
	            	@foreach(App\Models\Category::orderBy('title', 'asc')->where('parent_id',0)->get() as $parent)
	            		<option value="{{ $parent->id }}" {{ $parent->id == $product->category->id ? 'selected' : '' }}>{{ $parent->title }}</option>
	            		@foreach(App\Models\Category::orderBy('title', 'asc')->where('parent_id',$parent->id)->get() as $child)
	            			<option value="{{ $child->id }}" {{ $child->id == $product->category->id ? 'selected' : '' }}>——————>{{ $child->title }}</option>
	            		@endforeach
	            	@endforeach
	            </select>
	          </div>

	          <div class="form-group">
	            <label for="product_image">Product Image</label>
	            <input type="file" class="form-control" name="product_image" id="product_image">
	          </div>

	          <input type="submit" class="btn btn-success" value="Update">
	        </form>
     	</div>
   	</div>
  </div>
</div>
@endsection