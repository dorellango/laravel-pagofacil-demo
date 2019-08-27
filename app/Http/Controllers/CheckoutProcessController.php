<?php

namespace App\Http\Controllers;

use App\Order;
use PagoFacil\lib\Request as PagoFacilRequest;
use PagoFacil\lib\Transaction;

class CheckoutProcessController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Order $order)
    {
        $this->processPayment($order);
    }

    public function processPayment(Order $order)
    {
        $request = new PagoFacilRequest();
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

    public function initTransaction(PagoFacilRequest $request)
    {
        $transaction = new Transaction($request);
        $transaction->environment = 'DESARROLLO';
        $transaction->setToken(config('pagofacil.token.secret'));
        $transaction->initTransaction($request);
    }
}
