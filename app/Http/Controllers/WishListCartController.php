<?php

namespace App\Http\Controllers;

use App\Http\Abstracts\Cart;
use App\Http\Controllers\CartController;
use Illuminate\Http\Request;

class WishListCartController extends Cart
{
    protected $cartType;
    protected $cartController;
    protected $request;
    public function __construct(CartController $cartController, Request $request)
    {
        $this->cartController = $cartController;
        $this->request = $request;
        $this->cartType = 'wish-list-cart';
    }

    //list order cart items
    public function index(){
        $cartType = $this->cartType;
        $cartItems = $this->cartController->carts( $cartType );
        $orderItems = $this->cartController->carts( 'order-cart' );
        return view('wishCart',compact('cartItems','cartType','orderItems'));
    }

    //abstract method to add cart item
    public function addToCart($id = null)
    {
        // TODO: Implement addToCart() method.
        $this->cartController->addToCart($id,  $this->cartType );
        return redirect()->back()->with('success', 'Product added to Wish list Cart successfully!');
    }

    public function updateCart(){
        $this->cartController->updateCart($this->request->id, $this->request->quantity, $this->cartType);
    }

    //abstract method to remove cart item
    public function removeCartItem()
    {
        // TODO: Implement removeCartItem() method.
        $this->cartController->removeCartItem($this->request->id, $this->cartType );

    }

    public function clearCart(){
        $this->cartController->clearCart($this->cartType);
        return redirect()->back()->with('success', 'Wish list Cart empty successfully!');
    }

}
