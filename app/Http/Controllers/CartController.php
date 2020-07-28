<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Cart;

class CartController extends Controller
{

    public function carts($cartType = 'order-cart')
    {
        if (Auth::check()){
            $cartItems = Cart::where('cart_type',$cartType)
                ->where('user_id',Auth::id())
                ->get();
            $cartProducts = [];
//            dd($cartItems);
            foreach ($cartItems as $cartItem){
//                dd($cartItem->Product->toArray());
                $product = $cartItem->Product->toArray();
                $product +=['quantity'=>$cartItem->quantity];
                $cartProducts[$cartItem->product_id] = $product;
            }
           $cartItems = $cartProducts;
        } else {
            $cartItems = session($cartType);
        }
        return $cartItems;
    }

    public function addToCart($productId, $cartType = 'order-cart')
    {
        $product = Product::find($productId);
        if(!$product) {
            abort(404);
        }
        //if user logged in we store these data in database
        if(Auth::check()){
            $cart = $this->getCartItem($cartType,$productId);
            if($cart){
                $cart->quantity++;
                $cart->update();
            } else {
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $productId,
                    'cart_type' => $cartType,
                    'quantity'=>1
                ]);
            }
        }
            $cartItem = [
                "id" => $product->id,
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
                    $productId => $cartItem
                ];
                session()->put($cartType, $cart);
            } else {
                // if cart not empty then check if this product exist then increment quantity
                if (isset($cart[$productId])) {
                    $cart[$productId]['quantity']++;
                    session()->put($cartType, $cart);
                } else {
                    // if item not exist in cart then add to cart with quantity = 1
                    $cart[$productId] = $cartItem;
                    session()->put($cartType, $cart);
                }
            }
        return true;
    }

    public function updateCart($productId = null, $quantity = null, $cartType = 'order-cart') {
        if($productId and $quantity)
        {
            if(Auth::check()) {
                $cart = $this->getCartItem($cartType, $productId);
                if ($cart) {
                    $cart->quantity = $quantity;
                    $cart->update();
                }
            }
            $cart = session()->get($cartType);
            $cart[$productId]["quantity"] = $quantity;
            session()->put($cartType, $cart);
//            dd(session()->all());
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function removeCartItem($productId = null, $cartType = 'order-cart')
    {
        if($productId) {
            if(Auth::check()) {
                $cart = $this->getCartItem($cartType, $productId);
                if ($cart) {
                    $cart->delete();
                }
            }
            $cart = session()->get($cartType);
            if (isset($cart[$productId])) {
                unset($cart[$productId]);
                session()->put($cartType, $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function clearCart($cartType = 'order-cart'){
        if(Auth::check()) {
            $carts = Cart::where('user_id',Auth::id())
                ->where('cart_type',$cartType);
               if (count($carts->get()) > 0) {
               $carts->delete();
            }
        }
        session()->forget($cartType);
    }

    private function getCartItem($cartType = 'order-cart', $productId = null){
        $cart = Cart::where('user_id',Auth::id())
            ->where('cart_type',$cartType)
            ->where('product_id',$productId)
            ->first();
        return $cart;
    }

}
