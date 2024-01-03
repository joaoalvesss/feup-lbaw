<x-layout>
    <div class="100hv m-5">
        <div class="row mb-2">
            <h4 class="text-white">Your Cart</h4>
        </div>
        <section class="d-flex justify-content-around">
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th scope="col" style="white-space: nowrap; width: 1%";>Remove</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carts as $cart)
                        <x-cart-product :cart="$cart"/>
                    @endforeach
                </tbody>
            </table>

            <div class="checkout ms-5">
                <div class="card-body d-flex justify-content-between">
                    <div class="d-flex flex-row">
                        <h5 class="card-title m-3 text-white">Total:</h5>
                        <h5 class="card-subtitle mt-3 text-white total-price">{{$total}}€</h5>
                    </div>
                </div>

                <div class="purchase-buttons">
                    <form method="POST" action="/checkout">
                        @foreach ($addresses as $address)
                            <input type="radio" id="{{ $address }}" name="addressId" value="{{ $address->id }}">
                            <label for="{{ $address }}">{{ $address->label }}, {{ $address->street }}, {{ $address->postal_code }}</label><br>
                        @endforeach
                        @csrf
                        @if (!(count($addresses) > 0)) 
                            <div class="info-container">
                                <span class="info-icon" onclick="toggleInfoMessage()"><i class="fas fa-question-circle"></i></span>
                                <div class="info-message" style="display: none;">
                                    You don't have any addresses associated with your account. Please add one <a href="/users/{{auth()->user()->id}}">here</a> before checkout.
                                </div>
                            </div>
                        @endif
                        <button class="button1" type="submit">
                            Checkout
                        </button>
                    </form>
                    
                    <form method="POST" action="/cart">
                        @csrf
                        @method('DELETE')
                        <button class="button2" type="submit">
                            Clear Cart
                        </button>
                    </form>
                </div>
                
            </div>

        </section>
    </div>
    <script>
        function toggleInfoMessage() {
            var infoMessage = document.querySelector('.info-message');
            infoMessage.style.display = (infoMessage.style.display === 'none' || infoMessage.style.display === '') ? 'block' : 'none';
        }
    </script>
</x-layout>
