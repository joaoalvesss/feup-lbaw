<?php

namespace App\Http\Controllers;
use App\Models\Product;

class WishlistController extends Controller {
    
    public function index(){
        return view('users.wishlist',[
            'wishes' => auth()->user()->wishlist
        ]);
    }
    
    public function store(Product $product){
        $user = auth()->user();
        $wishlist = $user->wishlist()->where('product_id', $product->id)->first();

        if(!$wishlist){
            $user->wishlist()->attach($product->id);
        }
        else{
            return back()->with('message', 'Product is already in wishlist.');
        }

        return back()->with('message','Product added to wishlist.');
    }

    public function destroy(Product $product){  
        auth()->user()->wishlist()->detach($product->id);
        return back()->with('message','Product removed from wishlist.');
    }
}
