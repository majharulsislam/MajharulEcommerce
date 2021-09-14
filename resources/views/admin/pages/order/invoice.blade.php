<html>
<head>
	<title>Invoice {{ $order->id }}</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

	<style>
		.container{
			width: 750px;
		}
		.header_area{
			background: #ccc;
			padding-top: 15px;
		}
		.site-logo img{
			width: 150px;
			height: auto;
		}
		.site-address p a{
			display: inline-block;
		}
	</style>
</head>
<body>
	
<div class="container mmt-20">
	<div class="header_area">
		<div class="row">
			<div class="col-md-6">
				<div class="float-left site-logo">
			      <img src="{{ asset('images/mylogo.png') }}" alt="logo">
		      </div>
			</div>
			<div class="col-md-6">
				<div class="float-right site-address">
			     <h4>Majharul 2.0 eCommerce</h4>
			     <p>5355 Dinajpur, Rangpur</p>
			     <p><strong>Phone:</strong> <a href="tel:01728951505">01728951505</a></p>
			     <p><strong>Email:</strong> <a href="mail:majharul@gmail.com">majharul@gmail.com</a></p>
		      </div>
			</div>
			<div class="clearfix"></div>
		</div>
		<hr>
	</div>

	<div class="row">
		<div class="col-md-6 border-right">
			<p><strong>Ordered Name:</strong> {{ $order->name }}</p>
			<p><strong>Ordered Phone No:</strong> {{ $order->phone_no }}</p>
			<p><strong>Ordered Email:</strong> {{ $order->email }}</p>
			<p><strong>Ordered Shipping Address:</strong> {{ $order->shipping_address }}</p>
		</div>
		<div class="col-md-6">
			<h3>Invoice #LE{{ $order->id }}</h3>
			<p>{{ $order->created_at }}</p>
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
					<th>Product Quantity</th>
					<th>Unit Price</th>
					<th>Sub Total Price</th>
				</tr>
			</thead>
			<tbody>
				@php $total_amount = 0; @endphp
				@foreach ($order->carts as $key => $cart)
					<tr>
						<td>{{ $key+1 }}</td>

						<td><a href="{{ route('products.show',$cart->product->slug) }}">{{ $cart->product->title }}</a>
						</td>

						<td>{{ $cart->product_quantity }}</td>

						<td>
							{{ $cart->product->pricee }} Taka
						</td>

						<td>
							@php $total_amount += $cart->product->pricee * $cart->product_quantity
							@endphp
							{{ $cart->product->pricee * $cart->product_quantity}} Taka
						</td>
					</tr>
				@endforeach
				<tr>
					<td colspan="3"></td>
					<td><strong>Shipping Cost</strong></td>
					<td colspan="2"><strong>{{ $order->shipping_cost }} Taka</strong></td>
				</tr>
				<tr>
					<td colspan="3"></td>
					<td><strong>Discount</strong></td>
					<td colspan="2"><strong>{{ $order->custom_discount }} Taka</strong></td>
				</tr>
				<tr>
					<td colspan="3"></td>
					<td><strong>Total Amount</strong></td>
					<td colspan="2"><strong>{{ $total_amount + $order->shipping_cost - $order->custom_discount }} Taka</strong></td>
				</tr>
			</tbody>
		</table>
		 @endif
	</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


{{-- Note: PDF a css kaj korena.. Tobe inline css kaj kore.. css ar kaj koranor jnno way
	Khujte hobe.
 --}}

