<x-layout>
    <div class="container text-white mt-3">
        <h1>Product Management</h1>
        <div class="mb-3">
            <a href="/products/new" class="btn btn-primary">Create Product</a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 1%;" class="text-center">Image</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Platform</th>
                        <th class="text-center">Categories</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Stock</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="text-center"><img src="{{asset('storage/' . $product->image)}}" alt="{{ $product->name }}" width="120"></td>
                            <td id="product-a"><strong><a href="/products/{{$product->id}}">{{ $product->name }}</a></strong></td>
                            <td class="text-center">{{ $product->platform->name }}</td>
                            <td class="text-center">
                                {{$product->categories->pluck('name')->take(2)->implode(', ')}}
                            </td>
                            <td class="text-center">{{ $product->price }}</td>     
                            <td class="text-center">
                                <input type="number" value="{{$product->stock}}" class="stock-input" data-product-id="{{$product->id}}" min="0"/>
                            </td>
                            <td class="text-center">
                                <a href="/products/{{$product->id}}/edit" class="btn btn-warning">Edit</a>
                                <form action="/products/{{$product->id}}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{$products->links()}}
    </div>
</x-layout>
