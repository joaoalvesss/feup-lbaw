@props(['cart'])

<tr class="cart-table text-center mt-3 mb-3">
     <td class="cart-entry">
          <form method="POST" action="/cart/{{$cart->id}}" class="mb-3">
               @csrf
               @method('DELETE')
               <button class="btn text-danger" type="submit">
                   <i class="fas fa-trash"></i>
               </button>
          </form>
     </td>
     <td class="cart-entry">
          <img src="{{asset('storage/' . $cart->image)}}" alt="{{$cart->name}}" style = "width:150px"/>
     </td>
     
     <td class="cart-entry">
          <span>{{$cart->name}}</span>
     </td>

     <td class="cart-entry">
          <input type="number" value="{{$cart->pivot->quantity}}" class="quantity-input" data-product-id="{{$cart->id}}" min="1"/>
     </td>
   
     <td class="cart-entry">
          <span class="price">{{$cart->pivot->quantity * $cart->price}}€</span>
     </td>
</tr>					