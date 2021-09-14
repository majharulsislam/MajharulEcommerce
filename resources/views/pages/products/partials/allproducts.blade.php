<div class="row">
	@foreach ($products as $row)
	<div class="col-md-4 mmb-30">
	  <div class="card">

	    <!-- akta product id te 2ta image thakle 1tai show hbe -->
	    @php $i = 1; @endphp
	      @foreach( $row->ProductImages as $image ) 
	        @if($i > 0)
	        <a href="{{ route('products.show',$row->slug) }}"><img src="{{ asset('images/products/' .$image->name) }}" class="card-img-top featured-img" alt="{{ $row->title }}"></a>
	        @endif
	        @php $i--; @endphp
	      @endforeach


	    <div class="card-body">
	      <h5 class="card-title"><a href="{{ route('products.show',$row->slug) }}">{{ $row->title }}</a></h5>
	      <p><span style="font-size:30px;color:blue;">৳</span> {{ $row->pricee }}</p>
	      <p class="card-text">{{ $row->description }}</p>
	      @include('pages.products.partials.cart-button')
	    </div>
	  </div>
	</div>
	@endforeach
</div>

<div class="pagination mmb-30">
	{{ $products->links() }}
</div>