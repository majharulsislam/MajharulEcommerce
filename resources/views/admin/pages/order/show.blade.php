@extends ('admin.layouts.master')

@section('admin_content')
	
<div class="container mmt-20">
	<h2>View Order #LE{{ $order->id }}</h2>
	<hr>
	<div class="row">
		<div class="col-md-6 border-right"><h4>Order Information</h4></div>
		<div class="col-md-6"><h4>Order Payment</h4></div>
	</div>
	<div class="row">
		<div class="col-md-6 border-right">
			<p><strong>Ordered Name:</strong> {{ $order->name }}</p>
			<p><strong>Ordered Phone No:</strong> {{ $order->phone_no }}</p>
			<p><strong>Ordered Email:</strong> {{ $order->email }}</p>
			<p><strong>Ordered Shipping Address:</strong> {{ $order->shipping_address }}</p>
		</div>
		<div class="col-md-6">
			<p><strong>Order Payment Method:</strong> {{ $order->payment->name }}</p>
			<p><strong>Order Payment Transaction:</strong> {{ $order->transaction_id }}</p>
		</div>
	</div>
	<hr>

	<div class="cart_item">
		@if ($order->carts->count() > 0)
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>No.</th>
					<th>Product Title</th>
					<th>Product Image</th>
					<th>Product Quantity</th>
					<th>Unit Price</th>
					<th>Total Price</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				@php $total_amount = 0; @endphp
				@foreach ($order->carts as $key => $cart)
					<tr>
						<td>{{ $key+1 }}</td>

						<td><a href="{{ route('products.show',$cart->product->slug) }}">{{ $cart->product->title }}</a>
						</td>

						<td>
							@php $i=1; @endphp
							@foreach($cart->ProductImages as $image)
								@if($i > 0)
									<img src="{{ asset('images/products/'.$image->name) }}" alt="product-image" width="50px">
								@endif
								@php $i--; @endphp
							@endforeach
						</td>

						<td>
							<form action="{{ route('carts.update',$cart->id) }}" method="post">
								@csrf
								<input type="number" name="product_quantity" value="{{ $cart->product_quantity }}">
								<button type="submit" class="btn btn-sm btn-success">Update</button>
							</form>
						</td>

						<td>
							{{ $cart->product->pricee }} Taka
						</td>

						<td>
							@php $total_amount += $cart->product->pricee * $cart->product_quantity
							@endphp
							{{ $cart->product->pricee * $cart->product_quantity}} Taka
						</td>

						<td>
							<form action="{{ route('carts.delete',$cart->id) }}" method="post">
								@csrf
								<input type="hidden" name="cart_id" value="{{ $cart->id }}">
								<button type="submit" id="delete" class="btn btn-sm btn-danger">Delete</button>
							</form>
						</td>
					</tr>
				@endforeach
				<tr>
					<td colspan="4"></td>
					<td><strong>Total Amount</strong></td>
					<td colspan="2"><strong>{{ $total_amount }} Taka</strong></td>
				</tr>
			</tbody>
		</table>
		 @endif
	</div>
	<hr>

{{-- Shipping Charge and Custom discount form --}}
	<form action="{{ route('admin.order.charge', $order->id) }}" method="POST">
		@csrf
		<label for="shipping_cost">Shipping Cost: </label>
		<input type="number" name="shipping_cost" id="shipping_cost" value="{{ $order->shipping_cost }}">
		<label for="discount">Custom Discount: </label>
		<input type="number" name="custom_discount" id="discount" value="{{ $order->custom_discount }}">
		<input type="submit" value="Updated" class="btn btn-primary">
		
		<a href="{{ route('admin.order.invoice', $order->id) }}" class="btn btn-info" target="_blank">Generate invoice</a>
	</form>
	<hr>

{{-- Complete Form --}}
	<form action="{{ route('admin.order.complete', $order->id) }}" method="POST" style="display:inline-block !important;">
		@csrf
		@if($order->is_completed)
			<input type="submit" value="Cancel Order" class="btn btn-danger">
		@else
			<input type="submit" value="Completed" class="btn btn-success">
		@endif
	</form>

	<form action="{{ route('admin.order.paid', $order->id) }}" method="POST" style="display:inline-block !important;">
		@csrf
		@if($order->is_paid)
			<input type="submit" value="Cancel Paid" class="btn btn-danger">
		@else
			<input type="submit" value="Paid" class="btn btn-success">
		@endif
	</form>


</div>

@endsection