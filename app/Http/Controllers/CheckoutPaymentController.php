<?php

namespace App\Http\Controllers;

use App\Order;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Http\Request;
use PagoFacil\lib\Transaction;

class CheckoutPaymentController extends Controller
{
    public function callback(Request $request)
    {
        $transaction = new Transaction($request->all());
        $transaction->setToken(env('pagofacil.token.secret'));

        if ($transaction->validate($request->all())) {
            error_log('TRANSACCION CORRECTA');
        } else {
            error_log('ERROR FIRMA');
        }
    }

    public function complete(Request $request)
    {
        $transaction = new Transaction($request->all());
        $transaction->setToken(env('pagofacil.token.secret'));

        $order = Order::whereOrder($request->get('x_reference'))
            ->first();

        if ($order) {
            $order->markAsCompleted();
            CartFacade::session(auth()->id())->clear();
            return view('checkout.completed', compact('order'));
        }
    }

    public function cancel()
    {
        // :TODO
    }
}
