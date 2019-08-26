<?php

namespace App\Http\Controllers;

use App\Order;
use Darryldecode\Cart\Facades\CartFacade;
use PagoFacil\lib\Request;
use PagoFacil\lib\Transaction;

class CheckoutProcessController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Order $order = null)
    {
        if (!$order) {
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

        $this->processPayment($order);
    }

    public function getCartItems()
    {
        return CartFacade::session(auth()->id())->getContent();
    }

    public function processPayment(Order $order)
    {
        $request = new Request();
        $request->account_id = config('pagofacil.token.service');
        $request->amount = $order->fresh()->getSubtotal();
        $request->currency = 'CLP';
        $request->reference = $order->order;
        $request->customer_email = $order->owner->email;
        $request->url_complete = config('pagofacil.url.complete');
        $request->url_cancel = config('pagofacil.url.cancel');
        $request->url_callback = config('pagofacil.url.callback');
        $request->shop_country = 'CL';
        $request->session_id = str_random(61);

        $this->initTransaction($request);
    }

    public function initTransaction(Request $request)
    {
        $transaction = new Transaction($request);
        $transaction->environment = 'DESARROLLO';
        $transaction->setToken(config('pagofacil.token.secret'));
        $transaction->initTransaction($request);
    }
}
