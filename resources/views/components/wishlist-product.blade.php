@props(['wishlist'])

<tr class="cart-table text-center mt-3 mb-3">
     <td class="cart-entry">
          <form method="POST" action="/wishlist/{{$wishlist->id}}" class="mb-3">
               @csrf
               @method('DELETE')
               <button class="btn text-danger" type="submit">
                   <i class="fas fa-trash"></i>
               </button>
          </form>
     </td>
     <td class="cart-entry">
          <img src="{{asset('storage/' . $wishlist->image)}}" alt="{{$wishlist->name}}" style="width:150px"/>
     </td>
     
     <td class="cart-entry">
          <span>{{$wishlist->name}}</span>
     </td>
   
     <td class="cart-entry">
          <span class="price">{{$wishlist->price}}€</span>
     </td>

     <td class="cart-entry">
        <form method="POST" action="/cart/{{$wishlist->id}}">
            @csrf
            <button type="submit" class="btn btn-primary buy">Add To Cart</button>                         
       </form>
     </td>
</tr>					