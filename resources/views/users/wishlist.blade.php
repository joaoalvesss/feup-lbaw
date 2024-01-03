<x-layout>
    <div class="100hv m-5">
        <div class="row mb-2">
            <h4 class="text-white">Your Wishlist</h4>
        </div>
        <section class="d-flex justify-content-around">
            <table class="table">
                <thead>
                   <tr class="text-center">
                       <th scope="col">Remove</th>
                       <th scope="col">Image</th>
                       <th scope="col">Name</th>
                       <th scope="col">Price</th>
                       <th scope="col">Buy</th>
                   </tr>
                </thead>
                <tbody>
                    @foreach ($wishes as $wishlist)
                       <x-wishlist-product :wishlist="$wishlist"/>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>
</x-layout>
