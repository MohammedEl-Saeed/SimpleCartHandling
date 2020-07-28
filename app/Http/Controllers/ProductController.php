<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Controllers\CartController;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
//        session()->flush();
        $cartController = new CartController();
        $wishItems = $cartController->carts('wish-list-cart');
        $orderItems = $cartController->carts( 'order-cart' );
//        dd($orderItems,$wishItems);
        return view('product',compact('products','wishItems','orderItems'));
    }


    public function cart()
    {
        return view('cart');
    }


//    public function addToCart($id)
//    {
//        $product = Product::find($id);
//        if(!$product) {
//            abort(404);
//        }
//        $cartItem = [
//            "name" => $product->name,
//            "quantity" => 1,
//            "price" => $product->price,
//            "photo" => $product->photo
//        ];
//        $cart = session()->get('cart');
//        // if cart is empty then this the first product
//        if(!$cart) {
//            $cart = [
//                $id => $cartItem
//            ];
//            session()->put('cart', $cart);
//        }
//        // if cart not empty then check if this product exist then increment quantity
//        if(isset($cart[$id])) {
//            $cart[$id]['quantity']++;
//            session()->put('cart', $cart);
//        } else {
//            // if item not exist in cart then add to cart with quantity = 1
//            $cart[$id] = $cartItem;
//
//            session()->put('cart', $cart);
//        }
//        return redirect()->back()->with('success', 'Product added to cart successfully!');
//    }
}
