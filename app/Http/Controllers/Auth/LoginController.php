<?php

namespace App\Http\Controllers\Auth;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
//        dd(dd(session()->all()));
        $this->addItemsToCart('order-cart');
        $this->addItemsToCart('wish-list-cart');
    }

    private function addItemsToCart($cartType){
        $carts = session()->get($cartType);
        if($carts){
            foreach ($carts as $item){
               $cart = Cart::where('cart_type',$cartType)
                        ->where('user_id',Auth::id())
                        ->where('product_id',$item['id'])
                        ->first();
               if(is_null($cart)){
                   Cart::create([
                       'user_id' => Auth::id(),
                       'product_id' => $item['id'],
                       'cart_type' => $cartType,
                       'quantity'=>$item['quantity']
                   ]);
               }
            }
        }
    }
}
