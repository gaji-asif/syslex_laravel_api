<?php
# Copy the code from below to that controller file located at app/Http/Controllers/PaymentController.php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\DtbUser;
use Validator;
//use Stripe \ Stripe; 
//use Stripe \ Customer; 
//use Stripe \ Charge;
use Input;
use Stripe\Error\Card;
//use Cartalyst\Stripe\Stripe;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use DB;

class PaymentController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function handleonlinepay(Request $request){  

        $token = $request->header('token');
        $user_id = DtbUser::select('id')->where('api_token', $token)->first();
  
        //was good
        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
            'amount' => 'nullable',
            ]);
            $input = $request->all();
            //dd($input);
            if ($validator->passes()) { 
            $input = array_except($input,array('_token'));
            //dd(array('_token'));
            //$stripe = Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $stripe  =      Stripe::setApiKey('sk_test_CdAzjUeRIF13nsMSm2m3nk1b0046F2lEfg');

            try {
            $token = $stripe->tokens()->create([
            'card' => [
            'number' => $request->get('card_no'),
            'exp_month' => $request->get('ccExpiryMonth'),
            'exp_year' => $request->get('ccExpiryYear'),
            'cvc' => $request->get('cvvNumber'),
            ],
            ]);
            //dd($token);

            //$token['card']['id']
            if (!isset($token['id'])) {
            //return response ("Card Not Found");
            return response()->json([
                'status' => 'success',
                'data' => 'Card Not Found'
              ]); 
            //redirect()->route('addmoney.paymentstripe');
            }
            $charge = $stripe->charges()->create([
            'card' => $token['id'],
            'currency' => 'USD',
            'amount' => 20.49,
            'description' => 'wallet',
            ]);
            //dd($charge);
        
            if($charge['status'] == 'succeeded') {
            //echo "<pre>";
            //print_r($charge);
            //exit();
              // Insert into the databasee
              DB::table('payment_logs')->insert([                                         
                'amount'=> $charge['amount'],
                'balance_transaction'=> $charge['balance_transaction'],
                'payment_method'=>$charge['payment_method'],
                'user_id'=>$user_id,                     
                'card_id'=>$token['card']['id'],
                'created'=>$charge['created'],
                'status' => $charge['status']            ]);
            return response()->json([
                'status' => 'success',
                'data' => 'Payment  Successful'
              ]); 
            } else {

            return response()->json([
                'status' => 'success',
                'data' => 'Payment  Not Successful'
              ]); 
            }
            } catch (Exception $e) {
                return $e->getMessage();


            } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
                return $e->getMessage();

            } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                return $e->getMessage();

            }
            }
               
            }
        
}