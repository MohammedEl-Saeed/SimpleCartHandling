<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected function addToCart($id, $cartType = 'order-cart')
    {
        $product = Product::find($id);
        if(!$product) {
            abort(404);
        }
        $cartItem = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "type" => $product->type,
            "photo" => $product->photo
        ];
        $cart = session()->get($cartType);
        // if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                $id => $cartItem
            ];
            session()->put($cartType, $cart);
        } else {
            // if cart not empty then check if this product exist then increment quantity
            if (isset($cart[$id])) {
                $cart[$id]['quantity']++;
                session()->put($cartType, $cart);
            } else {
                // if item not exist in cart then add to cart with quantity = 1
                $cart[$id] = $cartItem;
                session()->put($cartType, $cart);
            }
        }
        return true;
    }

    protected function carts($cartType = 'order-cart'){
       $cartItems = session($cartType);
       return $cartItems;
    }

    protected function updateCart($id = null, $quantity = null, $cartType = 'order-cart') {

        if($id and $quantity)
        {
            $cart = session()->get($cartType);

            $cart[$id]["quantity"] = $quantity;

            session()->put($cartType, $cart);

            session()->flash('success', 'Cart updated successfully');
        }
    }

    protected function removeCartItem($id = null, $cartType = 'order-cart')
    {
        if($id) {
            $cart = session()->get($cartType);
            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put($cartType, $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    protected function clearCart($cartType = 'order-cart'){
        session()->forget($cartType);
    }

}
