<?php

namespace App\Http\Controllers;

use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Http\Request;

class CheckoutProcessController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $cartContent = CartFacade::session(auth()->id())
        ->getContent();

        $order = auth()->user()->orders()->create([
            'order' => str_random(20)
        ]);

        $cartContent->each(function ($product) use ($order) {
            $order->products()->attach(
                $product['id'],
                ['quantity' => $product['quantity']]
            );
        });
    }
}
