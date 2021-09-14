@extends('admin.layouts.master')

@section('admin_content')
<div class="row">
	<div class="col-md-8 grid-margin stretch-card">
    	<div class="card">
	      <div class="card-body">
	        <h4 class="card-title">Add new product</h4>

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

	        <form action="{{ route('product.store') }}" method="post" class="forms-sample" enctype="multipart/form-data" file="true">
	        	@csrf

	          <div class="form-group">
	            <label for="title">Title</label>
	            <input type="text" class="form-control" name="title" id="title" placeholder="Name">
	          </div>

	          <div class="form-group">
	            <label for="desc">Description</label>
	            <textarea class="form-control" name="desc" id="desc" rows="10" placeholder="write your message"></textarea>
	          </div>

	          <div class="form-group">
	            <label for="quantiry">Quantity</label>
	            <input type="number" class="form-control" name="quantity" id="quantiry" placeholder="Quantity">
	          </div>

	          <div class="form-group">
	            <label for="price">Price</label>
	            <input type="number" class="form-control" name="price" id="price" placeholder="Price">
	          </div>

	          <div class="form-group">
	            <label for="brand">Brand</label>
	            <select class="form-control" name="brand_id" id="brand">
	            	<option value="">— Select Brand —</option>
	            	@foreach(App\Models\Brand::orderBy('title', 'asc')->get() as $brand)
	            		<option value="{{ $brand->id }}">{{ $brand->title }}</option>
	            	@endforeach
	            </select>
	          </div>

	          <div class="form-group">
	            <label for="category">Category</label>
	            <select class="form-control" name="category_id" id="category">
	            	<option value="">— Select Category —</option>
	            	@foreach(App\Models\Category::orderBy('title', 'asc')->where('parent_id',0)->get() as $parent)
	            		<option value="{{ $parent->id }}">{{ $parent->title }}</option>
	            		@foreach(App\Models\Category::orderBy('title', 'asc')->where('parent_id',$parent->id)->get() as $child)
	            			<option value="{{ $child->id }}">——————>{{ $child->title }}</option>
	            		@endforeach
	            	@endforeach
	            </select>
	          </div>

	          <div class="form-group">
	            <label for="product_image">Product Image</label>
	            <input type="file" class="form-control" name="product_image" id="product_image">
	          </div>

	          <input type="submit" class="btn btn-success" value="Add Product">
	          <input type="reset" class="btn btn-light" value="cancel">
	        </form>
     	</div>
   	</div>
  </div>
</div>
@endsection