@extends('pages.user.master')

@section('user_content')
	<div class="container">
		<div class="row justify-content-center mmb-30">
			<div class="col-md-10">
				<div class="card">
					<h3 class="card-header">{{ __('Update Register') }}</h3>
						<div class="card-body">
	                    <form method="POST" action="{{ route('user.profile.update') }}">
	                        @csrf

	                        <div class="form-group row mmt-20">
	                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First name') }}</label>

	                            <div class="col-md-12">
	                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->first_name }}" required autocomplete="first_name" autofocus>

	                                @error('first_name')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
	                            </div>
	                        </div>

	                        <div class="form-group row mmt-20">
	                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last name') }}</label>

	                            <div class="col-md-12">
	                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->last_name }}" required autocomplete="last_name" autofocus>

	                                @error('last_name')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
	                            </div>
	                        </div>

	                        <div class="form-group row mmt-20">
	                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

	                            <div class="col-md-12">
	                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" required autocomplete="username" autofocus>

	                                @error('username')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
	                            </div>
	                        </div>

	                        <div class="form-group row mmt-20">
	                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

	                            <div class="col-md-12">
	                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

	                                @error('email')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
	                            </div>
	                        </div>

	                        <div class="form-group row mmt-20">
	                            <label for="phone_no" class="col-md-4 col-form-label text-md-right">{{ __('Phone No.') }}</label>

	                            <div class="col-md-12">
	                                <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ $user->phone_no }}" required autocomplete="phone_no">

	                                @error('phone_no')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
	                            </div>
	                        </div>

	                        <div class="form-group row mmt-20">
	                            <label for="division_id" class="col-md-4 col-form-label text-md-right">{{ __('Division Name') }}</label>

	                            <div class="col-md-12">
	                               <select class="form-control" name="division_id" id="division_id">
	                                   <option value="">— Select your division —</option>
	                                   @foreach ($divisions as $division)
	                                    <option value="{{ $division->id }}" {{ $user->division_id == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
	                                   @endforeach
	                               </select>
	                            </div>
	                        </div>

	                        <div class="form-group row mmt-20">
	                            <label for="district_id" class="col-md-4 col-form-label text-md-right">{{ __('District Name') }}</label>

	                            <div class="col-md-12">
	                               <select class="form-control" name="district_id" id="district_id">
	                                   <option value="">— Select your district —</option>
	                                   @foreach ($districts as $district)
	                                    <option value="{{ $district->id }}" {{ $user->district_id == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
	                                   @endforeach
	                               </select>
	                            </div>
	                        </div>

	                        <div class="form-group row mmt-20">
	                            <label for="street_address" class="col-md-4 col-form-label text-md-right">{{ __('Street Address') }}</label>

	                            <div class="col-md-12">
	                                <input id="street_address" type="text" class="form-control @error('street_address') is-invalid @enderror" name="street_address" value="{{ $user->street_address }}" required autocomplete="street_address">

	                                @error('street_address')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
	                            </div>
	                        </div>

	                        <div class="form-group row mmt-20">
	                            <label for="shipping_address" class="col-md-6 col-form-label text-md-right">{{ __('Shipping Address (Optional)') }}</label>

	                            <div class="col-md-12">
	                                <textarea id="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror" name="shipping_address" rows="4" autocomplete="shipping_address">{{ $user->shipping_address }}</textarea>

	                                @error('shipping_address')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
	                            </div>
	                        </div>

	                        <div class="form-group row mmt-20">
	                            <label for="password" class="col-md-6 col-form-label text-md-right">{{ __('New Password (Optional)') }}</label>

	                            <div class="col-md-12">
	                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

	                                @error('password')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
	                            </div>
	                        </div>

	                        <div class="form-group row mmt-20">
	                            <div class="col-md-6">
	                                <button type="submit" class="btn btn-primary">
	                                    {{ __('Update') }}
	                                </button>
	                            </div>
	                        </div>
	                    </form>
	                </div>
				</div>
			</div>
		</div>
	</div>
@endsection