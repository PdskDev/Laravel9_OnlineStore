<?php

namespace App\Http\Controllers;

use Stripe;
use Stripe\Charge;
use Stripe\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        $viewData = [];
        $viewData['title'] = "Online Store - Payment";
        $viewData['subtitle'] = "Stripe - Payment";
        return view('stripe.index')->with('viewData', $viewData);
    }
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
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
                      "amount"   => $request->input('amount'),// amount in cents  
                      "description" => "Order ".$request->input('order_id')                                               
                 ));

                 // store transaction info for logs
             }             
        }
              
        return view('cart.purchase');
    }
}