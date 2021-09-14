@extends('layouts.master')

 @section('commerce_content')
  <!-- Start sidebar + content -->
    <div class="container mmt-20">
      <div class="row">
        <div class="col-md-4">
          <div class="sidebar_area">
            <ul class="list-group">
              <li class="list-group-item">All Item</li>
            </ul>
          </div>
        </div>

        <div class="col-md-8">
          <div class="widget">
            <h3 class="mmb-30">Searched Products for <span class="badge bg-success">{{ $search }}</span></h3>
            @include('pages.products.partials.allproducts')
          </div>
        </div>
      </div>
    </div>
  <!-- End sidebar + content -->

@endsection