@props(['product'])

<div class="card">
    <div class="card m-1 h-100 product-card">
        <div class="card-body d-flex flex-column justify-content-center">
            <h5 class="card-title">
                <a href="{{ url('products/'.$product->id) }}" class="text-decoration-none text-white">
                    {{ $product->name }}
                </a>
            </h5>
            <div class="product-info mt-2">
                <a href="{{ url('products/'.$product->id) }}">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" width="auto" height="125">
                </a>
                <div class="d-flex justify-content-center align-items-center mt-3 text-white">
                    <h4 class="price">{{ $product->price }}€</h4>
                </div>
                @cannot('admin', App\Models\Product::class)
                <div class="text-center mt-2">
                    <form method="POST" action="/cart/{{$product->id}}">
                        @csrf
                        <button type="submit" class="btn btn-primary buy">Add To Cart</button>
                    </form>
                </div>
                @endcannot
            </div>
        </div>
    </div>
</div>
