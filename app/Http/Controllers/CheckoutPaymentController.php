<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PagoFacil\lib\Transaction;

class CheckoutPaymentController extends Controller
{
    public function callback(Request $request)
    {
        $transaction = new Transaction();
        $transaction->setToken(env('pagofacil.token.secret'));

        if ($transaction->validate($_POST)) {
            error_log('TRANSACCION CORRECTA');
        } else {
            error_log('ERROR FIRMA');
        }
    }

    public function complete()
    {
        $transaction = new Transaction();
        $transaction->setToken(env('pagofacil.token.secret'));

        if ($transaction->validate($_POST)) {
            echo 'Orden recibida exitosamente';
            error_log('TRANSACCION CORRECTA');
        } else {
            echo 'Error en firma';
            error_log('ERROR FIRMA');
        }
    }

    public function cancel()
    {
        // :TODO
    }
}
