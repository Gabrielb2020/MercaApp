<?php

namespace App\Services;

use App\Cart;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cookie;
use stdClass;

class CartService
{
    protected $cookieName;
    protected $cookieExpiration;

    public function __construct()
    {
        $this->cookieName = config('cart.cookie.name');
        $this->cookieExpiration = config('cart.cookie.expiration');
    }

    public function getFromCookie(): ?Cart
    {
        $cartId = Cookie::get($this->cookieName);

        $cart = Cart::find($cartId);

        return $cart;
    }

    public function getFromCookieOrCreate(): Cart
    {
        $cart = $this->getFromCookie();

        return $cart ?? Cart::create();
    }

    public function makeCookie(Cart $cart)
    {
        return Cookie::make($this->cookieName, $cart->id, $this->cookieExpiration);
    }

    public function countProducts(): int
    { 
        $cart = $this->getFromCookie();

        if($cart != null){
            return $cart->products->count();
        }
        
        return 0;
    }
}