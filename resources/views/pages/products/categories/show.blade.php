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
            <h3 class="mmb-30">Category <span class="badge bg-info">{{ $category->title }}</span></h3>

            	@php $products = $category->products()->simplePaginate(2); @endphp

            	@if ($products->count() > 0)
              		@include('pages.products.partials.allproducts')
              	@else
              		<div class="alert alert-danget">
              			No product added yet in this category!!
              		</div>
              	@endif
            </div>
        </div>
      </div>
    </div>
  <!-- End sidebar + content -->

@endsection