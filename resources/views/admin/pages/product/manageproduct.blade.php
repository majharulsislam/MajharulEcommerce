@extends('admin.layouts.master')

@section('admin_content')
<div class="row">
	<div class="col-md-10 grid-margin stretch-card">
    	<div class="card">
          <div class="card-body">
            <h4 class="card-title">Manage Product</h4>
            <table class="table table-bordered" id="dataTable">
              <thead>
                <tr>
                  <th> # </th>
                  <th> Product Code </th>
                  <th> Product Title </th>
                  <th> Price </th>
                  <th> Quantity </th>
                  <th> Action </th>
                </tr>
              </thead>

              <tbody>
              	@foreach ($productsall as $key => $product)
                <tr>
                  <td> {{ $key+1 }} </td>
                  <td> PLE{{ $product->id }} </td>
                  <td> {{ $product->title }} </td>
                  <td> {{ $product->pricee }} </td>
                  <td> {{ $product->quantity }} </td>
                  <td>
                  	<a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-sm btn-info"><i class="mdi mdi-circle-edit-outline"></i></a>

                  	<a href="{{ route('admin.product.delete',$product->id) }}" id="delete" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can-outline"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>

              <tfoot>
                <tr>
                  <th> # </th>
                  <th> Product Code </th>
                  <th> Product Title </th>
                  <th> Price </th>
                  <th> Quantity </th>
                  <th> Action </th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
 	</div>
</div>
@endsection