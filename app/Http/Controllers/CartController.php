<?php

namespace App\Http\Controllers;

use Darryldecode\Cart\Facades\CartFacade;

class CartController extends Controller
{
    public function show()
    {
        CartFacade::session(auth()->id());

        $products = CartFacade::getContent();

        return view('cart.show', compact('products'));
    }
}
