@extends('layouts.master')

@section('commerce_content')
	<div class="container mmt-20">
		<h2>My Carts Item</h2>
		<hr>

		
		<table class="table table-bordered table-hover table-responsive bg-light">
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
				@foreach ($carts as $key => $cart)
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
							<a href="{{ route('carts.delete', $cart->id) }}" id="delete" class="btn btn-sm btn-danger">Delete</a>
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

		<div class="checkout_area">
			<div class="float-end">
				<a href="{{ route('products') }}" class="btn btn-lg btn-info">Continue Shopping...</a>
				<a href="{{ route('payment.index') }}" class="btn btn-lg btn-warning">Checkout</a>
			</div>
		</div>
		
	</div>
@endsection