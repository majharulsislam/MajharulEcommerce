<div class="product_sidebar">
  <div class="list-group">

    @foreach(App\Models\Category::orderBy('title','asc')->where('parent_id',0)->get() as $parent)
    <a href="#main-{{ $parent->id }}" class="list-group-item" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="main-{{ $parent->id }}">
      <img src="{{ asset('images/categories/'.$parent->image) }}" alt="{{ $parent->title }}" width="60px">
      {{ $parent->title }}
    </a>

<!-- Sub Category -->
    <div class="child-rows collapse 
      @if (Route::is('product.category.show'))
        @if(App\Models\Category::ParentorNotCategory($parent->id,$category->id))
          show
        @endif
      @endif
    " id="main-{{ $parent->id }}">
      @foreach(App\Models\Category::orderBy('title','asc')->where('parent_id',$parent->id)->get() as $child)
      <a href="{{ route('product.category.show',$child->id) }}" class="list-group-item
        @if (Route::is('product.category.show'))
          @if($child->id == $category->id)
            active
          @endif
        @endif
        ">
        <img src="{{ asset('images/categories/'.$child->image) }}" alt="{{ $child->title }}" width="40px">
        {{ $child->title }}
      </a>
      @endforeach
    </div>
    @endforeach

  </div>
</div>