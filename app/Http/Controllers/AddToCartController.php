<?php

namespace App\Http\Controllers;

use App\Product;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Http\Request;

class AddToCartController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Product $product)
    {
        if (auth()->check()) {
            CartFacade::session(auth()->id());
        }

        CartFacade::add(
            $product->id,
            $product->name,
            $product->price,
            1
        );

        return redirect()->back();
    }
}
