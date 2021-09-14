@extends ('admin.layouts.master')

@section('admin_content')
	
<div class="container mmt-20">
	<h2>Manage All Order</h2>
	<hr>

	<table class="table table-bordered bg-light table-hover" id="dataTable">
		<thead>
			<tr>
				<th>No.</th>
				<th>Order ID</th>
				<th>Name</th>
				<th>Phone No.</th>
				<th>Order Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>

			@foreach($orders as $key => $order)
			<tr>
				<td>{{ $key+1 }}</td>
				<td>#LE{{ $order->id }}</td>
				<td>{{ $order->name }}</td>
				<td>{{ $order->phone_no }}</td>
				<td>
					<p>
						@if($order->is_seen_by_admin)
						<button class="btn btn-sm btn-primary">Seen</button>
						@else
						<button class="btn btn-sm btn-info">Unseen</button>
						@endif
					</p>

					<p>
						@if($order->is_paid)
						<button class="btn btn-sm btn-dark">Paid</button>
						@else
						<button class="btn btn-sm btn-warning">Unpaid</button>
						@endif
					</p>

					<p>
						@if($order->is_completed)
						<button class="btn btn-sm btn-success">Complete</button>
						@else
						<button class="btn btn-sm btn-danger">Incomplete</button>
						@endif
					</p>
				</td>
				<td>
					<a href="{{ route('admin.show.order', $order->id) }}" class="btn btn-info">
						<i class="mdi mdi-circle-edit-outline"></i>
					</a>
					<a href="{{ route('admin.order.delete', $order->id) }}" class="btn btn-danger" id="delete">
						<i class="mdi mdi-trash-can-outline"></i>
					</a>
				</td>
			</tr>
			@endforeach
		</tbody>

		<tfoot>
			<tr>
				<th>No.</th>
				<th>Order ID</th>
				<th>Name</th>
				<th>Phone No.</th>
				<th>Order Status</th>
				<th>Action</th>
			</tr>
		</tfoot>
	</table>
	
</div>

@endsection