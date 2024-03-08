<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\AdyenClient;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

use BookingProtect\InsuranceHub\Client as BP;
use GuzzleHttp\Client;

use Hash;
use Session;
use Auth;
use DB;
use Stripe;

use App\Models\ApiKeySetting;
use App\Models\BookingGlobal;
use App\Models\BookingBillingAddress;
use App\Models\BookingTickets;
use App\Models\BookingPayments;
use App\Models\BookingeTickets;
use App\Models\Payment;

class PartnerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $proceed;
    protected $checkout;
    public function __construct(Request $request,AdyenClient $checkout)
    {  
        $this->proceed = "true";
        $this->checkout = $checkout->service;
        $this->check_token($request);        
    }

    public  function check_token($request)
    { 
       
         
           $token           = $request->post('paymentkey');
           $booking_no      = $request->post('booking_no');
           $environmental   = $request->post('environmental');


            if($token != "" && $booking_no != "" && $environmental != ""){ 

                $setting = ApiKeySetting::where('payment_key',$token)->where('api_type',$environmental)->first();
                if(@$setting->id == ""){
                      $this->proceed = "notfound";
                } 

            }
            else{
                  $this->proceed = "invalid";

            }

           

    }

    
   

    

    
    public function orders(Request $request)
    {
        if($this->proceed == "notfound"){
            return redirect('notfound');
        }
        else if($this->proceed == "invalid"){
            return redirect('invalid');
        }  
        if($request->booking_no == ""){
            return redirect('notfound');
        }
        $booking_no = $request->booking_no;
        $lang       = "en";
        $booking = BookingGlobal::select('booking_global.*',
                                    'booking_tickets.*',
                                    'register.first_name as buyer_first_name',
                                    'register.last_name as buyer_last_name',
                                    'booking_billing_address.*')

                             ->where('booking_global.booking_no',$booking_no)
                             ->leftJoin('booking_tickets', function($join) {
                                            $join->on('booking_tickets.booking_id', '=', 'booking_global.bg_id');
                                        })
                            ->leftJoin('booking_billing_address', function($join) use($lang) {
                                    $join->on('booking_billing_address.booking_id','=','booking_global.bg_id');
                            })
                            ->leftJoin('booking_payments', function($join) use($lang) {
                                    $join->on('booking_payments.booking_id','=','booking_global.bg_id');
                            })
                            ->leftJoin('register', function($join) use($lang) {
                                    $join->on('register.id','=','booking_global.user_id');
                            })
                            ->first();
      // echo "<pre>";print_r($booking);exit;

        if($booking->bg_id != ""){

            $order_create_date = $booking->created_at;
            $current_date      = date('Y-m-d h:i:s');
            $session_minutes = abs(strtotime($current_date) - strtotime($order_create_date));
            if($session_minutes < 1000000){
                $payment_price  = $booking->total_amount;
                $payment_currency = $booking->currency_type;

                if(PAYMENT_METHOD == 'ADYEN'){

                    try {
                
                    $reference = $booking->booking_no;
                    $params = array(
                    'amount' => array(
                    'currency' => $payment_currency,
                    'value' => $payment_price*100
                    ),
                    'countryCode' => 'AE',
                    'merchantAccount' => env('ADYEN_MERCHANT_ACCOUNT'),
                    'reference' => $reference,
                    'returnUrl' => url("paymentresp/{$booking->booking_no}")
                    );
                    $result = $this->checkout->sessions($params);
                  // echo "<pre>";print_r($result);exit;
                
                }
                catch (\Throwable $t) {
                    $this->payment_error($t->getMessage());
                }
                 catch (\Stripe\Exception\ApiErrorException $e) {
                
                $this->payment_error($e->getError()->message);

                } catch (Exception $e) {

                $this->payment_error($e);

                }    

                 

            if($result['id'] != ""){

                $payment_data = array(
                'booking_id'            => $booking->bg_id,
                'payment_type'           => 1,
                'payment_status'         => 0,
                'payment_method'         => PAYMENT_METHOD,
                'payment_id'            => $result['id']
                );

                $payment = Payment::create($payment_data);

                $booking_no    = md5($result['reference']);
                $payment_url = url("paymentresp/{$booking->booking_no}");
                $response = ["booking_id" =>$booking->bg_id,"booking_no" => $booking->booking_no,"sessionData" => $result['sessionData'],"sessionid" => $result['id'],"payment_url" => $payment_url,'payment_method' => PAYMENT_METHOD,'status' => 1];
                //echo "<pre>";print_r($response);exit;
                 return view('frontend.payment.checkoutpartner',compact('response'));

            }

              
                }
            }
            else{
                 return redirect('expired');
            }
            
        }
   
        
    }

   
    public function payment_error($payment_error='')
    {
        $error = $payment_error;
       return view('frontend.payment.payment_error',compact('error'));
    }

}