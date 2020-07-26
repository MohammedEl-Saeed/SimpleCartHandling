<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CartController;
use Illuminate\Http\Request;

class WishListCartController extends CartController
{
    protected $cartType;

    public function __construct()
    {
        $this->cartType = 'wish-list-cart';
    }

    //add wishlist cart item
    public function addToWishListCart($id)
    {
        $this->addToCart($id,  $this->cartType );
        return redirect()->back()->with('success', 'Product added to Wishlist Cart successfully!');
    }

    //list wishlist cart items
    public function wishListCart(){
        $cartItems = $this->carts($this->cartType);
//        dd($cartItems);
        $cartType = $this->cartType;
        return view('cart',compact('cartItems','cartType'));
    }

    public function update(Request $request){
        $this->updateCart($request->id, $request->quantity, $this->cartType);
    }

    public function remove(Request $request){
        $this->removeCartItem($request->id, $this->cartType);
    }

    public function clear(){
        $this->clearCart($this->cartType);
        return redirect()->back()->with('success', 'Wishlist Cart empty successfully!');
    }

}
