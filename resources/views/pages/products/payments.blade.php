@extends('layouts.master')

@section ('commerce_content')
	<div class="container mmt-20">
		<div class="card card-body mmb-30">
			<h3>My Checkouts Product</h3>
			<hr>
			<div class="row">
				<div class="col-md-7 border-end">
					@foreach($carts as $key => $cart)
						<p> {{ $key+1 }}. 
							{{ $cart->product->title }} - 
							<strong>{{ $cart->product->pricee }} Taka</strong> - 
							<span class="badge bg-info">{{ $cart->product_quantity }} Item</span>
						</p>
					@endforeach
					<a href="{{ route('carts.index') }}">Change carts item</a>
				</div>

				<div class="col-md-5">
					@php $product_amount = 0; @endphp
					@foreach($carts as $cart)
						@php
							$product_amount += $cart->product->pricee * $cart->product_quantity;
						@endphp
					@endforeach
					<p>Product Price - <strong>{{ $product_amount }} Taka</strong></p>
					@php
						$shipping_amount = App\models\Setting::first()->shipping_cost;
					@endphp
					<p class="border-bottom border-info pb-3">Shipping Cost - <strong>{{ $shipping_amount }}</strong></p>
					<p>Total Amount = <strong>{{ $product_amount + $shipping_amount }} Taka</strong></p>
				</div>
			</div>
		</div>


		<div class="card card-body mmt-20">
			<h3>Shipping Address</h3>
			<form method="post" action="{{ route('payment.store') }}">
                @csrf
                <div class="form-group row mmt-20">
                    <label for="receiver_name" class="col-md-2 offset-md-2 col-form-label text-md-right">{{ __('Receiver Name') }}</label>

                    <div class="col-md-6">
                        <input id="receiver_name" type="text" class="form-control @error('receiver_name') is-invalid @enderror" name="receiver_name" value="{{ Auth::check() ? Auth::user()->first_name : '' }} {{ Auth::check() ? Auth::user()->last_name : '' }}" autocomplete="receiver_name" autofocus required>

                        @error('receiver_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mmt-20">
                    <label for="email" class="col-md-2 offset-md-2 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mmt-20">
                    <label for="phone_no" class="col-md-2 offset-md-2 col-form-label text-md-right">{{ __('Phone No.') }}</label>

                    <div class="col-md-6">
                        <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ Auth::check() ? Auth::user()->phone_no : '' }}" required autocomplete="phone_no">

                        @error('phone_no')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mmt-20">
                    <label for="shipping_address" class="col-md-2 offset-md-2 col-form-label text-md-right">{{ __('Shipping Address') }}</label>

                    <div class="col-md-6">
                        <textarea id="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror" name="shipping_address" rows="4" autocomplete="shipping_address">{{ Auth::check() ? Auth::user()->shipping_address : '' }}</textarea>

                        @error('shipping_address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mmt-20">
                    <label for="message" class="col-md-2 offset-md-2 col-form-label text-md-right">{{ __('Additional message (Optional)') }}</label>

                    <div class="col-md-6">
                        <textarea id="message" class="form-control @error('message') is-invalid @enderror" name="message" rows="4" autocomplete="message"></textarea>

                        @error('message')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mmt-20">
                    <label for="payment_method" class="col-md-2 offset-md-2 col-form-label text-md-right">{{ __('Payment method *') }}</label>

                    <div class="col-md-6">
                        <select class="form-control" name="payment_method" id="payment_method" required>
                            <option value="">— Select your payment method —</option>
                            @foreach($payments as $payment)
                                <option value="{{ $payment->short_name }}">{{ $payment->name }}</option>
                            @endforeach
                        </select>

                        {{-- Payment method setting --}}
                        @foreach ($payments as $payment)
                          @if ($payment->short_name == "cash_in")
                            <div id="payment_{{ $payment->short_name }}" class="hidden alert alert-success text-center mmt-20">
                                <h4>
                                    For cash in there is nothing necessary.Just click finish order. <br>
                                    <small>You will get your product just 2 or 3 business days.</small>
                                </h4>
                            </div>
                          @else
                            <div id="payment_{{ $payment->short_name }}" class="hidden alert alert-success text-center mmt-20">
                                <h4>{{ $payment->name }} Payment</h4>
                                <p>
                                    <strong>{{ $payment->name }} No. {{ $payment->no }}</strong> <br>
                                    <strong>Account type - {{ $payment->type }}</strong>
                                </p>
                                <div class="alert alert-success">
                                    Please send the above money to this {{ $payment->name }} No and write your transaction code below there.(*)
                                </div>
                            </div>
                          @endif
                        @endforeach
                        <input type="text" class="form-control mmt-20 hidden" name="transaction_id" id="transaction_id" placeholder="Enter your transaction code">
                        {{-- End payment method setting --}}

                        @error('payment_method')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mmt-20">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Order Now') }}
                        </button>
                    </div>
                </div>
            </form>
		</div>
	</div>
@endsection