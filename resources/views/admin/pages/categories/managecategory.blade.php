@extends('admin.layouts.master')

@section('admin_content')
<div class="row">
	<div class="col-md-10 grid-margin stretch-card">
    	<div class="card">
          <div class="card-body">
            <h4 class="card-title">Manage Category</h4>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th> # </th>
                  <th> Category Name </th>
                  <th> Category Slug </th>
                  <th> Parent Category </th>
                  <th> Category Image </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>

                @foreach ($categories as $key => $category)
                <tr>
                  <td> {{ $key+1 }} </td>
                  <td> {{ $category->title }} </td>
                  <td> {{ $category->slug }} </td>

                  <td> 
                      @if ($category->parent_id == 0)
                        Primary Category
                      @else
                        {{ $category->parents->title }}
                      @endif
                  </td>

                  <td><img src="{{ asset('images/categories/'.$category->image) }}" alt="image"></td>

                  <td>
                  	<a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-sm btn-info"><i class="mdi mdi-circle-edit-outline"></i></a>

                  	<a href="{{ route('admin.category.delete',$category->id) }}" id="delete" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can-outline"></i></a>
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>
          </div>
        </div>
 	</div>
</div>
@endsection