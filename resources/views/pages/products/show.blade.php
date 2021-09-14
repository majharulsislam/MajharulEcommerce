@extends('layouts.master')

@section('title')
  {{ $products->title }} | Laravel Ecommerce Project
@endsection

 @section('commerce_content')
  <!-- Start sidebar + content -->
    <div class="container mmt-20">
      <div class="row">

        <div class="col-md-4">
          <div class="sidebar_area">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">

                @php $i = 1; @endphp
                @foreach ($products->ProductImages as $image)
                <div class="carousel-item {{ $i==1 ? 'active' : '' }}">
                  <img src="{{ asset('images/products/'.$image->name) }}" class="d-block w-100" alt="{{ $products->title }}">
                </div>
                @php $i++; @endphp
                @endforeach
                
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>

            <div class="brand_category">
              <p>Brand <span class="badge bg-info">{{ $products->brand->title }}</span></p>
              <p>Category <span class="badge bg-info">{{ $products->category->title }}</span></p>
            </div>
          </div>
        </div>

        <div class="col-md-8">
          <div class="widget">
            <h3 class="mmb-30">{{ $products->title }}</h3>
            <h4 class="mmb-30">{{ $products->pricee }} Taka <span class="badge bg-secondary">{{ $products->quantity < 1 ? 'No item in stock' : $products->quantity.' item is available' }}</span></h4>
            <hr>
            <div class="product_desc">
              {{ $products->description }}
            </div>
          </div>
        </div>
      </div>
    </div>
  <!-- End sidebar + content -->

@endsection