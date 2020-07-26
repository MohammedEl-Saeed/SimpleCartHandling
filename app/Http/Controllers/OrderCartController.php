<?php

namespace App\Http\Controllers;
use App\Http\Controllers\CartController;
use App\Product;
use Illuminate\Http\Request;

class OrderCartController extends CartController
{
    protected $cartType;

    public function __construct()
    {
        $this->cartType = 'order-cart';
    }
    //add order cart item
    public function addToOrderCart($id)
    {
        $this->addToCart($id,  $this->cartType );
        return redirect()->back()->with('success', 'Product added to Order Cart successfully!');
    }

    //list order cart items
    public function orderCart(){
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
        return redirect()->back()->with('success', 'Order Cart empty successfully!');
    }
}
