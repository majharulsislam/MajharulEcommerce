@extends('layouts.master')

 @section('commerce_content')
  <!-- Start sidebar + content -->
    <div class="container mmt-20">
      <div class="row">

        <div class="col-md-4">
          @include('partials.product_sidebar')
        </div>

        <div class="col-md-8">
          <div class="widget">
            <h3 class="mmb-30">Products</h3>
            @include('pages.products.partials.allproducts')
          </div>
        </div>
      </div>
    </div>
  <!-- End sidebar + content -->

@endsection