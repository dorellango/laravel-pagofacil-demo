<?php

namespace App\Http\Controllers;

use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Http\Request;

class PlaceOrderController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $order = auth()->user()->orders()->create([
            'order' => str_random(20)
        ]);

        $this->getCartItems()->each(function ($product) use ($order) {
            $order->products()->attach(
                $product['id'],
                ['quantity' => $product['quantity']]
            );
        });
    }

    public function getCartItems()
    {
        return CartFacade::session(auth()->id())->getContent();
    }
}
