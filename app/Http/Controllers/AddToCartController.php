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
    public function __invoke(Product $product, Request $request)
    {
        $validated = $request->validate(['quantity' => 'required']);

        CartFacade::session(auth()->id());

        CartFacade::add(
            $product->id,
            $product->name,
            $product->price,
            $validated['quantity']
        );

        return redirect()->back();
    }
}
