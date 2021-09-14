@extends('admin.layouts.master')

@section('admin_content')
<div class="row">
	<div class="col-md-10 grid-margin stretch-card">
    	<div class="card">
          <div class="card-body">
            <h4 class="card-title">Manage Brands</h4>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th> # </th>
                  <th> Brand Name </th>
                  <th> Brand Slug </th>
                  <th> Brand Image </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>

                @foreach ($brands as $key => $brand)
                <tr>
                  <td> {{ $key+1 }} </td>
                  <td> {{ $brand->title }} </td>
                  <td> {{ $brand->slug }} </td>

                  <td>
                    <img src="{{ asset('images/brands/'.$brand->image) }}" alt="{{ $brand->title }}">
                  </td>

                  <td>
                  	<a href="{{ route('admin.brand.edit', $brand->id) }}" class="btn btn-sm btn-info"><i class="mdi mdi-circle-edit-outline"></i></a>

                  	<a href="{{ route('admin.brand.delete',$brand->id) }}" id="delete" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can-outline"></i></a>
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