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
                  <th> Division Name </th>
                  <th> Division Priority </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>

                @foreach ($divisions as $key => $division)
                <tr>
                  <td> {{ $key+1 }} </td>
                  <td> {{ $division->name }} </td>
                  <td> {{ $division->priority }} </td>

                  <td>
                  	<a href="{{ route('admin.division.edit', $division->id) }}" class="btn btn-sm btn-info"><i class="mdi mdi-circle-edit-outline"></i></a>

                  	<a href="{{ route('admin.division.delete',$division->id) }}" id="delete" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can-outline"></i></a>
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