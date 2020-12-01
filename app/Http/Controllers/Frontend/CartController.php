<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $items = Cart::content();
//        dd($items);
        return view('frontend.cart.list');
    }
    public function add($id)
    {
        $product = Product::find($id);
        Cart::add($product->id, $product->name, 1, $product->sale_price, 0);
        return redirect()->route('frontend.cart.index');
    }

    public function remove($cart_id)
    {
        Cart::remove($cart_id);
        return redirect()->route('frontend.cart.index');
    }
}
