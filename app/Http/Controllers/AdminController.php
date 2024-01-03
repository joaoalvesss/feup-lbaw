<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Purchase;

class AdminController extends Controller
{
    public function show(){ 
        $products = Product::count();
        $categories = Category::count();
        $orders = Purchase::count();
        $users = User::count();

        return view('admin.show',[
            'products' => $products,
            'categories' => $categories,
            'orders' => $orders,
            'users' => $users
        ]);
    }
}
