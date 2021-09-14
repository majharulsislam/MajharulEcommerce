@extends('admin.layouts.master')

@section('admin_content')
<div class="row">
	<div class="col-md-8 grid-margin stretch-card">
    	<div class="card">
	      <div class="card-body">
	        <h4 class="card-title">Add New Brand</h4>

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

	        <form action="{{ route('admin.brand.store') }}" method="post" class="forms-sample" enctype="multipart/form-data" file="true">
	        	@csrf
	          <div class="form-group">
	            <label for="title">Title</label>
	            <input type="text" class="form-control" name="title" id="title" placeholder="Name">
	          </div>
	          <div class="form-group">
	            <label for="desc">Description</label>
	            <textarea class="form-control" name="description" id="desc" rows="10" placeholder="write your message"></textarea>
	          </div>

	          <div class="form-group">
	            <label for="image">Image</label>
	            <input type="file" class="form-control" name="image" id="image">
	          </div>

	          <input type="submit" class="btn btn-success" value="Add Brand">
	          <input type="reset" class="btn btn-light" value="cancel">
	        </form>
     	</div>
   	</div>
  </div>
</div>
@endsection