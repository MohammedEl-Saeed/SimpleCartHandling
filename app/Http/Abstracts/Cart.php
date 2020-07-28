<?php

namespace App\Http\Abstracts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class Cart extends Controller
{

    protected $cartType;

    abstract protected function addToCart();

    abstract protected function removeCartItem();

    protected  function index(){
         // return all items in this cart type;
     }
    protected  function updateCart(){
        // update cart item
    }
    protected  function clearCart(){
        // update cart item
    }

}
