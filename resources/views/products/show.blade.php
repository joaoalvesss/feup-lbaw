@php
  $hasCommented = $reviews->contains(function ($review){
    return $review->user_id == auth()->id() && $review->comment != null;
  });
@endphp

<x-layout>
    <div class="pb-4 product">
        <h1 class="card-title mt-3 ms-4 text-white">
            {{ $product->name }}
            @if($product->platform->name !== 'PC')
                <span class="platform-info">({{ $product->platform->name }})</span>
            @endif
        </h1>        
        <div class="images">
            <img src="{{ asset('storage/' . $product->image2) }}" class="img-fluid" alt="IMG1">
        </div>
        <div class="details text-white"> 
            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt="IMG1">
            <h3 class="mt-3 mb-2 me-3">Product Description</h3>
            <p class="card-text me-3">{{ $product->description }}</p>

            <h6 class="card-text me-3"><strong>Price:</strong> {{ $product->price }}€</h6>
            <h6 class="card-text me-3"><strong>Release Date:</strong> {{ $product->publication_date }}</h6>
            <h6 class="card-text me-3"><strong>Score:</strong> 
                @for ($i = 1; $i <= 5; $i++)
                  @if ($i <= $product->score)
                    &#9733;
                  @else
                    &#9734;
                  @endif
                @endfor
            </h6>
            <h6 class="card-text me-3">
                <strong>Stock:</strong> 
                @if ($product->stock >= 1)
                  Available
                @else
                  Out of stock
                @endif
            </h6>  
            <h6 class="card-text me-3">
                <strong>Genres:</strong>
                @foreach ($product->categories as $category)
                  {{ $category->name }}
                  @if (!$loop->last)
                    ,
                  @endif
                @endforeach
            </h6>
        </div>
        @cannot('admin', App\Models\Product::class)
        <div class="d-flex justify-content-center align-items-center mt-3 buttons">
          <form method="POST" action="/cart/{{$product->id}}">
            @csrf
            <button type="submit" class="btn btn-primary buy me-2">Add To Cart</button>
          </form>
          <form method="POST" action="/wishlist/{{$product->id}}">
            @csrf
            <button type="submit" class="btn btn-primary buy ms-2">Add To Wishlist</button>
          </form>
        </div>
        @endcannot
    </div>
    <div>
      @auth
        @cannot('comment', [App\Models\Review::class, $hasCommented])
          <x-review-form :product="$product->id"/>
        @endcannot
      @endauth
      @unless(count($reviews) == 0)
        <div>
          <div>
            <div>
        @foreach ($reviews as $review)
                <x-review :review="$review"/> 
                @if(!$loop->last) 
                  <hr/>
                @endif
        @endforeach
            </div>
          </div>
        </div>  
      @endunless
  </div>
</x-layout>