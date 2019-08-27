<?php

namespace App\Http\Controllers;

use App\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PagoFacil\lib\Transaction;

class CheckoutPaymentController extends Controller
{
    /**
     * Callback endpoint
     *
     * @param Request $request
     * @return void
     */
    public function callback(Request $request)
    {
        $this->validateSignature($request);

        if (!$order = $this->getOrder($request->get('x_reference'))) {
            throw new Exception('The given order does not exist', 422);
        }

        $order->markAsCompleted();
    }

    /**
     * Complete view
     *
     * @param Request $request
     * @return void
     */
    public function complete(Request $request)
    {
        $this->validateSignature($request);

        Log::debug($request->all());

        if ($order = $this->getOrder($request->get('x_reference'))) {
            return view('checkout.completed', compact('order'));
        }

        return 'The given order does not exist';
    }

    /**
     * Get order by number
     *
     * @param string $referenceOrder
     * @return App\Order
     */
    private function getOrder($referenceOrder)
    {
        return Order::whereOrder($referenceOrder)->first();
    }

    /**
     * Validate the given signature from request
     *
     * @param Request $request
     * @return void
     */
    public function validateSignature(Request $request)
    {
        $transaction = new Transaction();
        $transaction->setToken(config('pagofacil.token.secret'));
        if (!$transaction->validate($request->all())) {
            throw new Exception('Invalid signature', 422);
        }
    }

    public function cancel()
    {
        // :TODO
    }
}
