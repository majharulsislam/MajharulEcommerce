@extends('admin.layouts.master')

@section('admin_content')
<div class="row">
	<div class="col-md-8 grid-margin stretch-card">
    	<div class="card">
	      <div class="card-body">
	        <h4 class="card-title">Edit Category</h4>

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

	        <form action="{{ route('admin.category.update',$editcate->id) }}" method="post" class="forms-sample" enctype="multipart/form-data" file="true">
	        	@csrf
	          <div class="form-group">
	            <label for="title">Title</label>
	            <input type="text" class="form-control" name="title" id="title" value="{{ $editcate->title }}">
	          </div>
	          <div class="form-group">
	            <label for="desc">Description</label>
	            <textarea class="form-control" name="description" id="desc" rows="10">{{ $editcate->description }}</textarea>
	          </div>
	          
	          <div class="form-group">
	            <label for="pr_id">Parent Category (optional)</label>
	            <select class="form-control" id="pr_id" name="parent_id">
	            	<option value="0">Select</option>
	            	@foreach ($parent_categories as $parentcategory)
	            		<option value="{{ $parentcategory->id }}" {{ ( $parentcategory->id == $editcate->parent_id) ? 'selected' : '' }}>{{ $parentcategory->title }}</option>
	            	@endforeach
	            </select>
	          </div>

	          <div class="form-group">
	            <label for="oldimage">Old Image</label>
	            <img src="{{ asset('images/categories/'.$editcate->image) }}" alt="Category old image">
	            <br>
	            <br>
	            <label for="new_img">Change Image (Optional)</label>
	            <input type="file" class="form-control" id="new_img" name="image">
	          </div>

	          <input type="submit" class="btn btn-dark" value="Update Category">
	          <input type="reset" class="btn btn-warning" value="cancel">
	        </form>
     	</div>
   	</div>
  </div>
</div>
@endsection