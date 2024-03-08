<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

use Hash;
use Session;
use Auth;
use DB;
use Stripe;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /*public function add_to_cart(Request $request)
    { 
        $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'add_to_cart?lang='.Session::get('locale'), [
            'match_id'      => base64_decode($request->match_id),
            'quantity'      => $request->quantity,
            'sell_ticket_id'=> base64_decode($request->sell_ticket_id),
            'stadium_id'    => base64_decode($request->stadium_id),
            'ip'            => $request->ip(),
        ]); 
        $results  = $response['result'];
        Session::put('cart_id', trim($results['cart_id']));
        Session::put('cart_quantity', trim($request->quantity));
        return redirect('checkout');
    }
*/
    public function add_to_cart(Request $request)
    { 
        $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'add_to_cart?lang='.Session::get('locale'), [
            'match_id'      => base64_decode($request->match_id),
            'quantity'      => $request->quantity,
            'sell_ticket_id'=> base64_decode($request->sell_ticket_id),
            'stadium_id'    => base64_decode($request->stadium_id),
            'ip'            => $request->ip(),
        ]); 
        $results  = $response['result'];
        Session::put('cart_id', trim($results['cart_id']));
        Session::put('cart_quantity', trim($request->quantity));
        echo "1";
        //return redirect('checkout');
    }
    public function checkout(Request $request)
    {
        $cartId = Session::get('cart_id');
        if($cartId == ""){
            return redirect('');
        }
        $cart_response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'cart?lang='.Session::get('locale')."&currency=".Session::get('currency'),[
            'cart_id' => Session::get('cart_id')
            ]);
        $results = $cart_response['result'];

        // $minutes = (strtotime($results['expriy_datetime']) - time()) / 60;
        // if($minutes < 0 )
        // {
        //     $delete = $this->cart_delete($request);
        //     Session::forget('cart_id');
        //     return redirect('');
        // }

        $country_response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->get(API_URL .'country');
        $country = $country_response['results'];
        $states ="";
        if(Session::get('country')){ 
            $state_response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'state?lang='.Session::get('locale'),[
                'country_id' => Session::get('country')
                ]);
            $states = $state_response['results'];
            
        } 
        $title =  "
        ";
        $description =  "Checkout";
        return view('frontend.payment.checkout',compact('results','country','cartId','title','description','states'));
    }

    public function checkout_post(Request $request)
    {
        $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'checkout?lang='.Session::get('locale'), [
            'cart_id'       => base64_decode($request->cart_id),
            'title'         => $request->title,
            'user_id'         => Session::get('user_id'),
            'first_name'    => $request->firstname,
            'last_name'     => $request->lastname,
            'email'         => $request->email,
            'dialing_code'  => $request->dialling_code,
            'mobile_no'     => $request->phone_number,
            'address'       => $request->address,
            'postal_code'   => $request->postcode,
            'country_id'    => $request->country,
            'state_id'      => $request->city,
            'ip_address'    => $request->ip(),
        ]); 
        
        if(isset($response['booking_id'])) {
            $response = ["booking_id" =>$response['booking_id'],'status' => 1];
            return response($response, 200);
        }
        else{
            $response = ["message" => $response['message'] ,'status' => 0];
            return response($response, 200);
        }
    }

      public function makePayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'booking_id' => 'required|int',
           'stripeToken' => 'required',
       ]);
        
       if ($validator->fails()) { 
            Session::flash('error', $validator->messages()->first());
            return redirect()->back()->withInput();
       }
       else{
    
          $booking_response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'booking?lang='.Session::get('locale'),[
                'booking_id' => $request->booking_id,
                'store_id'   => 13
                ]);
          $booking = $booking_response['booking'];
          if(!isset($booking['bg_id']) && !$booking['bg_id']){
            Session::forget('cart_id', trim($results['cart_id']));
            $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'payment_update?lang='.Session::get('locale'), [
                        'booking_id' => $booking['bg_id'],
                        'payment_type' => 1,
                        'payment_status' => 0,
                        'message' => 'Invalid Booking details provided',
            ]); 
            return redirect('confirmation/'.md5($booking['booking_no']));
          }
           
        try {

          
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $paymentIntent =  Stripe\Charge::create ([
                "amount" => $booking['total_amount'] * 100,
                "currency" => $booking['currency_type'],
                "source" => $request->stripeToken,
                'metadata' => array(
                            'booking_no' => $booking['booking_no']
                        ),
                "description" => 'booking_no - '.$booking['booking_no'].' - '.$booking['match_name'].' - '.$booking['stadium_name'].' - '.$booking['seat_category'].' - '.$booking['seat_category'].' - '.$booking['ticket_id'].' - '.$booking['match_date'].' - '.$booking['match_time']
        ]);

      
         if ($paymentIntent->amount_refunded == 0 && empty($paymentIntent->failure_code) && $paymentIntent->paid == 1 && $paymentIntent->captured == 1) {

                $amount = $paymentIntent->amount;
                $balance_transaction = $paymentIntent->balance_transaction;
                $currency = $paymentIntent->currency;
                $paymentstatus = $paymentIntent->status;

                if($paymentstatus == 'succeeded'){
                    $payment_status = 1;
                }
                else if($paymentstatus == 'failed'){
                    $payment_status = 0;
                }
                else if($paymentstatus == 'pending'){
                    $payment_status = 2;
                }
                else if($paymentstatus == 'reversed'){
                    $payment_status = 3;
                }
                else if($paymentstatus == 'canceled'){
                    $payment_status = 4;
                }


             
               $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'payment_update?lang='.Session::get('locale'), [
                                'booking_id' => $booking['bg_id'],
                                'payment_type' => 1,
                                'payment_status' => $payment_status,
                                'transcation_id' => $balance_transaction,
                                'payment_response' => json_encode($paymentIntent),
                                'total_payment' => $amount/100,
                                'message' => 'success',
                                'currency_code' => $currency
                ]); 

         }
         else{


                $amount = $paymentIntent->amount;
                $balance_transaction = $paymentIntent->balance_transaction;
                $currency = $paymentIntent->currency;
                $paymentstatus = $paymentIntent->status;

                if($paymentstatus == 'succeeded'){
                    $payment_status = 1;
                }
                else if($paymentstatus == 'failed'){
                    $payment_status = 0;
                }
                else if($paymentstatus == 'pending'){
                    $payment_status = 2;
                }
                else if($paymentstatus == 'reversed'){
                    $payment_status = 3;
                }
                else if($paymentstatus == 'canceled'){
                    $payment_status = 4;
                }


                    $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'payment_update?lang='.Session::get('locale'), [
                                'booking_id' => $booking['bg_id'],
                                'payment_type' => 1,
                                'payment_status' => $payment_status,
                                'transcation_id' => $balance_transaction,
                                'payment_response' => json_encode($paymentIntent),
                                'message' => 'unknown',
                                'total_payment' => $amount/100,
                                'currency_code' => $currency
                ]); 


         }
       

        } catch (\Stripe\Exception\ApiErrorException $e) {
     
          $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'payment_update?lang='.Session::get('locale'), [
                    'booking_id' => $booking['bg_id'],
                            'payment_type' => 1,
                            'payment_status' => 0,
                            'payment_response' => json_encode($e->getError()),
                            'message' => '400 - '.$e->getError()->message,
            ]); 

      
        } catch (Exception $e) {
      

          $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'payment_update?lang='.Session::get('locale'), [
                            'booking_id' => $booking['bg_id'],
                            'payment_type' => 1,
                            'payment_status' => 0,
                            'payment_response' => json_encode($e),
                            'message' => '500 - '.$e,
            ]); 
    
        }
        Session::forget('cart_id');
        Session::forget('cart_quantity');
        return redirect('confirmation/'.md5($booking['booking_no']));

       }

      
        //return back();
    }

    public function cart_delete(Request $request)
    {
        $delete_response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'delete_cart?lang='.Session::get('locale'),[
                            'ip' => $request->ip()
                        ]);
        $results = $delete_response;
        if($results['status'] == 1)
        {   Session::forget('cart_id');
            Session::forget('cart_quantity');
            $response = ["message" =>$results['message'],'status' => 1];
            return response($response, 200);
        }else 
        {
            $response = ["message" => $results['message'] ,'status' => 0];
            return response($response, 200);
        }
    }

    public function update_cart(Request $request)
    {
        $cart_id = Session::get('cart_id');
       
        $delete_response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'update_cart?lang='.Session::get('locale'),[
                            'ip'            => $request->ip(),
                            'cart_id'       => $cart_id
                ]);
        $results = $delete_response;
        if($results['status'] == 1)
        {   

            $itemid = array();
            $old = strtotime(date("m/d/Y h:i:s ", time()));
            $new = strtotime(date('m/d/Y, h:i:s',strtotime($results['result']['expriy_datetime'])));
            $time = ($new - $old);
            $response = ["message" =>$results['message'],'time' => $time ,'status' => 1];
            return response($response, 200);
        }else 
        {
            $response = ["message" => $results['message'] ,'status' => 0];
            return response($response, 200);
        }
    }
    
}