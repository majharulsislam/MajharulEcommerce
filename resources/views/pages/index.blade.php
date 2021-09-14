@extends('layouts.master')

 @section('commerce_content')

{{-- Slider --}}
  <div class="row">
    <div class="col-md-12">
      <div class="slider_area">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>

          {{-- Slider Item --}}
          <div class="carousel-inner">
            @foreach($sliders as $slider)
            <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
              <img src="{{ asset('images/slider/'.$slider->image) }}" class="d-block w-100" alt="{{ $slider->title }}" style="height: 450px;">

              <div class="carousel-caption d-none d-md-block mmb-30">
                <h3>{{ $slider->title }}</h3>
                <p>{{ $slider->sub_title }}</p>

                @if($slider->button_text)
                <p class="mmt-20"><a href="{{ $slider->button_link }}" class="btn btn-danger">{{ $slider->button_text }}</a></p>
                @endif
              </div>

            </div>
            @endforeach
          </div>

          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Start sidebar + content -->
    <div class="container">
      {{-- All Products --}}
      <div class="row mmt-20">
        <div class="col-md-4">
            @include('partials.product_sidebar')
        </div>

        <div class="col-md-8">
          <div class="widget">
            <h3 class="mmb-30">Featured Products</h3>
              @include('pages.products.partials.allproducts')
            </div>
        </div>
      </div>
    </div>
  <!-- End sidebar + content -->

@endsection