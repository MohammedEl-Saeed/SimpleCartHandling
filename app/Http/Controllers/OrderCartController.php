<?php

namespace App\Http\Controllers;
use App\Http\Controllers\CartController;
use App\Product;
use App\Http\Abstracts\Cart;
use Illuminate\Http\Request;

class OrderCartController extends Cart
{
    protected $cartType;
    protected $cartController;
    protected $request;
    public function __construct(CartController $cartController, Request $request)
    {
        $this->cartController = $cartController;
        $this->request = $request;
        $this->cartType = 'order-cart';
    }

    //list order cart items
    public function index(){
        $cartType = $this->cartType;
        $cartItems = $this->cartController->carts( $cartType );
        $wishItems = $this->cartController->carts( 'wish-list-cart' );
        return view('cart',compact('cartItems','cartType','wishItems'));
    }

    //add order cart item
    public function addToCart($id = null)
    {
        // TODO: Implement addToCart() method.
        $this->cartController->addToCart($id,  $this->cartType );
        return redirect()->back()->with('success', 'Product added to Order Cart successfully!');
    }

    public function updateCart(){
        $this->cartController->updateCart($this->request->id, $this->request->quantity, $this->cartType);
    }

    public function removeCartItem()
    {
        // TODO: Implement removeCartItem() method.
        $this->cartController->removeCartItem($this->request->id, $this->cartType );

    }

    public function clearCart(){
        $this->cartController->clearCart($this->cartType);
        return redirect()->back()->with('success', 'Order Cart empty successfully!');
    }

}
