<?php

namespace App\Http\Controllers;

use Stripe\Charge;
use Stripe\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController​ extends Controller
{
    public function checkout(Request $request)
    {
        // get your logged in customer
        $customer = Auth::user();

        // when client hit checkout button
        if( $request->isMethod('post') ) 
        {
             // stripe customer payment token
             $stripe_token = $request->get('stripe_token');

             // make sure that if we do not have customer token already
             // then we create nonce and save it to our database
             if ( !$customer->stripe_token ) 
             {
                   // once we received customer payment nonce
                   // we have to save this nonce to our customer table
                   // so that next time user does not need to enter his credit card details
                   $result = \Stripe\Customer::create(array(
                       "email"  => $customer->email,
                       "source" => $stripe_token
                   ));

                   if( $result && $result->id )
                   {
                       $client->stripe_id = $result->id;
                       $client->stripe_token = $stripe_token;
                       $client->save();
                   }
             }

             if( $customer->stripe_token) 
             {
                 // charge customer with your amount
                 $result = \Stripe\Charge::create(array(
                      "currency" => "eur",
                      "customer" => $customer->stripe_id,
                      "amount"   => 200 // amount in cents                                                 
                 ));

                 // store transaction info for logs
             }             
        }

        return view('checkout.index');

    }
}