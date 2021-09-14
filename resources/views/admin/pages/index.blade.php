@extends('admin.layouts.master')

@section('admin_content')

  <div class="wrapper">
    <div class="card card-body">
      <h2>Welcome to your Dashboard</h2>
      <hr>
      <p><a href="{{ route('index') }}" class="btn btn-lg btn-primary">Visit website</a></p>
    </div>
  </div>

@endsection

