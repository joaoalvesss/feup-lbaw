<?php

namespace App\Http\Controllers;

use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    public function payment(){
        if(!in_array(request()->price, [5, 10, 20, 35, 50, 100]))
            return back()->with('message', 'Please choose a valid value');

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => url("/payment/success"),
                "cancel_url" => url("/payment/cancel")
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "EUR",
                        "value" => request()->price,
                    ]
                ]
            ]
        ]);

        if(isset($response['id']) && $response['id'] != 'null'){
            foreach($response['links'] as $link){
                if($link['rel'] === 'approve' ){
                    

                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect("/payment/cancel")->with('message', 'payment failed');
        }
    }

    public function success(){
        if(request()->token == null){
            abort('404', 'Not Found');
        }

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();   
        $response = $provider->capturePaymentOrder(request()->token);  
        
        if(isset($response['purchase_units'][0]['payments']['captures'][0]['amount']['value'])){
            $credits = floatval($response['purchase_units'][0]['payments']['captures'][0]['amount']['value']);
            auth()->user()->credits += $credits;
            auth()->user()->update();
        }
        
        
        if(isset($response['status']) && $response['status'] == "COMPLETED")
            return view('paypal.success');
        else 
            return redirect("/payment/cancel")->with('message', 'Payment failed');
    }

    public function cancel(){
        return view('paypal.cancel');
    }
}
