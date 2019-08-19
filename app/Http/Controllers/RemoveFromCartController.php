<?php

namespace App\Http\Controllers;

use App\Product;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Http\Request;

class RemoveFromCartController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Product $product, Request $request)
    {
        CartFacade::session(auth()->id());
        CartFacade::remove($product->id);

        return redirect()->back();
    }
}
