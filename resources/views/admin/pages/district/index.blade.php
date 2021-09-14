@extends('admin.layouts.master')

@section('admin_content')
<div class="row">
	<div class="col-md-10 grid-margin stretch-card">
    	<div class="card">
          <div class="card-body">
            <h4 class="card-title">Manage Division</h4>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th> #SL </th>
                  <th> District Name </th>
                  <th> Division Name </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>

                @foreach ($districts as $key => $district)
                <tr>
                  <td> {{ $key+1 }} </td>
                  <td> {{ $district->name }} </td>
                  <td> {{ $district->division->name }} </td>

                  <td>
                  	<a href="{{ route('admin.district.edit', $district->id) }}" class="btn btn-sm btn-info"><i class="mdi mdi-circle-edit-outline"></i></a>

                  	<a href="{{ route('admin.district.delete',$district->id) }}" id="delete" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can-outline"></i></a>
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