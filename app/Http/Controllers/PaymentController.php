<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Triverla\LaravelMonnify\Facades\Monnify;

class PaymentController extends Controller
{

    /**
     * Redirect the Customer to Monnify Payment Page
     * @return Url
     */
    public function redirectToMonnifyGateway()
    {
        try{
            return Monnify::payment()->makePaymentRequest()->redirectNow();
        }catch(\Exception $e) {
            return Redirect::back()->withMessage(['message'=>'The Monnify token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }        
    }

    /**
     * Get payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Monnify::payment()->getPaymentData();

        dd($paymentDetails);
        // Now you have the payment details,
        // you can then redirect or do whatever you want
    }

    public function showPaymentForm()
    {
        //$user = Auth::user();

        return view('payment');
    }
}