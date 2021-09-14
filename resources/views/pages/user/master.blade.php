@extends('layouts.master')

@section('commerce_content')
	<div class="container content_area">
		<div class="row mmt-20">
			<div class="col-md-4">
				<div class="list-group">
					<a href="#" class="list-group-item text-center">
						<img src="{{ App\Helpers\ImageHelper::getUserImage(Auth::user()->id) }}" alt="User-image" width="100px">
					</a>
					<a href="{{ route('user.dashboard') }}" class="list-group-item {{ Route::is('user.dashboard') ? 'active' : '' }}">Dashboard</a>

					<a href="{{ route('user.profile') }}" class="list-group-item {{ Route::is('user.profile') ? 'active' : '' }}">Update Profile</a>
				</div>
			</div>
			<div class="col-md-8">
				<div class="card card-body">
					@yield('user_content')
				</div>
			</div>
		</div>
	</div>
@endsection