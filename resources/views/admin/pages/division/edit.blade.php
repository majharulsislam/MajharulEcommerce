@extends('admin.layouts.master')

@section('admin_content')
<div class="row">
	<div class="col-md-8 grid-margin stretch-card">
    	<div class="card">
	      <div class="card-body">
	        <h4 class="card-title">Edit Division</h4>

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

	        <form action="{{ route('admin.division.update',$division->id) }}" method="post" class="forms-sample" enctype="multipart/form-data" file="true">
	        	@csrf

	          <div class="form-group">
	            <label for="title">Division Name :</label>
	            <input type="text" class="form-control" name="name" id="title" value="{{ $division->name }}">
	          </div>

	          <div class="form-group">
	            <label for="pr">Priority :</label>
	            <input type="number" class="form-control" name="priority" id="pr" value="{{ $division->priority }}">
	          </div>

	          <input type="submit" class="btn btn-success" value="Submit">
	          <input type="reset" class="btn btn-light" value="cancel">
	        </form>
     	</div>
   	</div>
  </div>
</div>
@endsection