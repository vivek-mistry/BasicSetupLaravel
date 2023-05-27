<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $cart = Cart::where('product_id', '=', $request->product_id)->first();

        $product = Product::find($request->product_id);

        if(!$cart)
        {
            $cart = new Cart();
            $cart->product_id = $request->product_id;
            $cart->quantity = 1;
            $cart->per_quantity_price = $product->price;
            $cart->total_price = $product->price;
            $cart->save();

            return response()->json(['message' => 'Add New Item'],200);
        }

        $cart->quantity = $cart->quantity+1;
        $cart->total_price = $cart->total_price+$product->price;
        $cart->save();
        return response()->json(['message' => 'Cart Item Updated'],200);

    }

    public function remove($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return response()->json(['message' => 'Remove from Cart'],200);
    }

    public function detail()
    {
        $data['cart'] = Cart::with(['product', 'product.category'])->get();

        return view('cart_detail')->with($data);
    }
}
