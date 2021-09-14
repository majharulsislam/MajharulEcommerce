@extends('pages.user.master')

@section('user_content')
	<div class="container">
		<h2>Welcome {{ $user->first_name . ' '.$user->last_name }}</h2>
		<p>You can change your profile and every information here....</p>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-4">
			<div class="card card-body text-center">
				<h4><a href="{{ route('user.profile') }}" onclick="location.href='{{ route('user.profile') }}'">Update Profile</a></h4>
			</div>
		</div>
	</div>
@endsection