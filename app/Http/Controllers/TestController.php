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

class TestController extends Controller
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

    public function cart(Request $request,$lang,$base_id)
    {
      
        $cart_id = base64_decode($base_id); 
        if($cart_id){
            $cart_response =  Http::withHeaders([
                    'Accept' => 'application/json',
                    'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'check_cart?lang='.Session::get('locale')."&currency=".Session::get('currency'),[
                        'cart_id' => $cart_id
                    ]);
            $results = $cart_response['result']; 
            if($results){
                $delete_response =  Http::withHeaders([
                    'Accept' => 'application/json',
                    'domainkey' => DOMAIN_KEY
                ])->post(API_URL .'update_cart?lang='.Session::get('locale'),[
                                    'ip'            => $request->ip(),
                                    'cart_id'       => $cart_id
                        ]);
                $results = $delete_response;
                if($results['status'] == 1){ 
                    return redirect(app()->getLocale()."/".'checkout');
                }
                else{

                }
            }
            else{

            }
        }
    }
        
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
    public function checkout(Request $request,$lang)
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
        if($results){


            //echo "<pre>";print_r($results);exit;
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
            $title =  "Checkout";
            $description =  "Checkout";
            return view('frontend.payment.testcheckout',compact('results','country','cartId','title','description','states'));
        }
        else{
             Session::forget('cart_id');
            Session::forget('cart_quantity');
            return redirect(app()->getLocale());
        }
    }

    public function payment_success(Request $request,$lang,$booking_no){

            $booking_response =  Http::withHeaders([
                'Accept' => 'application/json',
                'domainkey' => DOMAIN_KEY
            ])->post(API_URL .'booking_details?lang='.Session::get('locale'),[
            'booking_no' => $booking_no,
            ]); 
         
            $booking = $booking_response['booking'];
            if(@$_GET['error'] != 'error'){
                if(@$_GET['payment_intent'] != ''){
              
                $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
                $paymentres = $stripe->paymentIntents->retrieve(
                $_GET['payment_intent']
                );
                $paymentIntent = $paymentres->charges->data[0];
                 


         if ($paymentIntent->amount_refunded == 0 && empty($paymentIntent->failure_code) && $paymentIntent->paid == 1 && $paymentIntent->captured == 1) {

                $amount = $paymentIntent->amount_captured;
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
                                'booking_id'        => $booking['bg_id'],
                                'payment_type'      => 1,
                                'payment_status'    => $payment_status,
                                'transcation_id'    => $balance_transaction,
                                'payment_response'  => json_encode($paymentres),
                                'total_payment'     => $amount/100,
                                'message'           => 'success',
                                'currency_code'     => $currency,
                                'ip_address'        => $request->ip(),
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
                                'currency_code' => $currency,
                                'ip_address'        => $request->ip(),
                ]); 
         }

        Session::forget('cart_id');
        Session::forget('cart_quantity');

         return redirect(app()->getLocale().'/confirmation/'.md5($booking['booking_no']));

            }
        }
        else{

                  $response =  Http::withHeaders([
                            'Accept' => 'application/json',
                            'domainkey' => DOMAIN_KEY
                        ])->post(API_URL .'payment_update?lang='.Session::get('locale'), [
                                'booking_id' => $booking['bg_id'],
                                'payment_type' => 1,
                                'payment_status' => 0,
                                'transcation_id' => '',
                                'payment_response' => json_encode($_GET['payment_intent']),
                                'message' => 'unknown',
                                'total_payment' => 0,
                                'currency_code' => '',
                                'ip_address'        => $request->ip(),
                ]); 

                 Session::forget('cart_id');
                Session::forget('cart_quantity');

                return redirect(app()->getLocale().'/confirmation/'.md5($booking['booking_no']));
            }
                

               
        
    }

    public function card_process(Request $request){
           // ini_set('memory_limit', '64M');
           // echo $request->booking_no;exit;
            $booking_response =  Http::withHeaders([
                'Accept' => 'application/json',
                'domainkey' => DOMAIN_KEY
            ])->post(API_URL .'booking_details?lang='.Session::get('locale'),[
            'booking_no' => $request->booking_no,
            ]); 
         
            $booking = $booking_response['booking'];


            if($booking['bg_id'] != ''){

            

             try {
                
                $network_response =  Http::withHeaders([
                'Accept' => 'application/json',
                'domainkey' => DOMAIN_KEY
                ])->post(API_URL .'network_response?lang='.Session::get('locale'),[
                'booking_id' => md5($booking['bg_id']),
                ]); //echo "<pre>";print_r($network_response['response']);exit;

                }
                 catch (\Throwable $t) {
                    custom_error_log($t->getMessage());
                 }
                 catch (\Stripe\Exception\ApiErrorException $e) {
                custom_error_log($e->getError()->message);
                } catch (Exception $e) {
                custom_error_log($e);
                } 

             try { 

            $access_token        = $network_response['response']['token'];
            $orderCreateResponse = json_decode($network_response['response']['response']);
            $cardpay_url = $orderCreateResponse->_embedded->payment[0]->_links->{'payment:card'}->href;
            } 
            catch (\Throwable $t) {
                custom_error_log($t->getMessage());
               // echo $t->getMessage(), " at ", $t->getFile(), ":", $t->getLine(), "\n";exit;
            }
            catch (\Stripe\Exception\ApiErrorException $e) {
                custom_error_log($e->getError()->message);
            } catch (Exception $e) {
                custom_error_log($e);
            } 
            $postData = (object)[];
            $postData->pan = $request->card_number;
            $postData->expiry = $request->expiryYear.'-'.$request->expiryMonth;
            $postData->cvv = $request->cvv;
            $postData->cardholderName = $request->card_holder_name;
            $json = json_encode($postData);
            $orderCreateHeaders  = array("Authorization: Bearer ".$access_token, "Content-Type: application/vnd.ni-payment.v2+json", "Accept: application/vnd.ni-payment.v2+json");
           
             try {
                $orderCreateResponse = $this->invokeCurlRequest("PUT", $cardpay_url, $orderCreateHeaders, $json);

                }
                catch (\Throwable $t) {
                custom_error_log($t->getMessage());
               // echo $t->getMessage(), " at ", $t->getFile(), ":", $t->getLine(), "\n";exit;
            }
                 catch (\Stripe\Exception\ApiErrorException $e) {
                custom_error_log($e->getError()->message);
                } catch (Exception $e) {
                custom_error_log($e);
                } 
            $output = json_decode($orderCreateResponse);
            //echo "<pre>";print_r($output);exit;
            $state = $output->state;

            

             try {
                
                $update_payment_id =  Http::withHeaders([
                'Accept' => 'application/json',
                'domainkey' => DOMAIN_KEY
                ])->post(API_URL .'payment_create?lang='.Session::get('locale'),[
                'booking_id' => $booking['bg_id'],
                'payment_method' => PAYMENT_METHOD,
                'payment_id'   => $output->orderReference
                ]); 

                }
                catch (\Throwable $t) {
                custom_error_log($t->getMessage());
               // echo $t->getMessage(), " at ", $t->getFile(), ":", $t->getLine(), "\n";exit;
                }
                 catch (\Stripe\Exception\ApiErrorException $e) {
                custom_error_log($e->getError()->message);
                } catch (Exception $e) {
                custom_error_log($e);
                }

            if ($state == "AWAIT_3DS") {

            $cnp3ds_url = $output->_links->{'cnp:3ds'}->href;
            $acsurl = $output->{'3ds'}->acsUrl;
            $acspareq = $output->{'3ds'}->acsPaReq;
            $acsmd = $output->{'3ds'}->acsMd;
            $acsterm = url(app()->getLocale()."/networkPaRes");
            }
            else{
         $res = json_decode($orderCreateResponse,true);

        $payment_status = 0;

        if($state == "PURCHASED" || $state == "CAPTURED"){
            $payment_status = 1;
        }
        else if($state == "FAILED"){
            $payment_status = 0;
        }
        $amount = $res['amount']['value'];
        $currency = $res['amount']['currencyCode'];
        $balance_transaction = $res['reference'];
    
        $post_data = [
                        'booking_id' => $booking['bg_id'],
                        'payment_type' => 1,
                        'payment_status' => $payment_status,
                        'transcation_id' => $balance_transaction,
                        'payment_response' => json_encode($orderCreateResponse),
                        'total_payment' => $amount/100,
                        'message' => $state,
                        'currency_code' => $currency
                ];

        //pr(json_encode($post_data)); die;
        $response =  Http::withHeaders([
                'Accept' => 'application/json',
                'domainkey' => DOMAIN_KEY
            ])->post(API_URL .'payment_update?lang='.Session::get('locale'), $post_data); 
                $payment_url = url(app()->getLocale().'/confirmation/'.MD5($booking['booking_no']));
                $response = ["booking_id" => $booking['bg_id'],'payment_url' => $payment_url,'status' => 1,'msg' => 'success'];
                return response($response, 200);

            }
            $payment_url = url(app()->getLocale()."/ds3/".base64_encode($acsurl).'/'.base64_encode($acsterm).'/'.base64_encode($acspareq).'/'.base64_encode($acsmd).'/'.base64_encode($cnp3ds_url).'/'.md5($booking['booking_no']));
            $response = ["booking_id" => $booking['bg_id'],'payment_url' => $payment_url,'status' => 1,'msg' => 'success'];
          //  echo $payment_url;exit;
            return response($response, 200);


             }

            
           
    }

    public function networkPaRes($lang,$returnres,$booking_id)
    {  

        $booking_response =  Http::withHeaders([
                'Accept' => 'application/json',
                'domainkey' => DOMAIN_KEY
            ])->post(API_URL .'booking_details?lang='.Session::get('locale'),[
            'booking_no' => $booking_id,
            ]); 
        $booking = $booking_response['booking'];
        //pr($booking);die;
        //echo $lang.'='.$returnres.'='.$booking_id;
        //echo "<pre>";print_r($_POST);exit;
         $pares=$_POST['PaRes'];
        $returnres=base64_decode($returnres);
        $postData = (object)[];
        $postData->PaRes = $pares;

        $json = json_encode($postData);
        $token='';
        
        $orderCreateHeaders  = array("Authorization: Bearer ".$token, "Content-Type: application/vnd.ni-payment.v2+json", "Accept: application/vnd.ni-payment.v2+json");

        
                 try {
                
               $orderCreateResponse = $this->invokeCurlRequest("POST", $returnres, $orderCreateHeaders, $json);

                }
                catch (\Throwable $t) {
                //custom_error_log($t->getMessage());
               // echo $t->getMessage(), " at ", $t->getFile(), ":", $t->getLine(), "\n";exit;
                }
                 catch (\Stripe\Exception\ApiErrorException $e) {
                //custom_error_log($e->getError()->message);
                } catch (Exception $e) {
                //custom_error_log($e);
                }

        $res = json_decode($orderCreateResponse,true);
    
        $payment_status = 0;
        if($res['state'] == "PURCHASED" || $res['state'] == "CAPTURED"){
            $payment_status = 1;
        }
        else if($res['state'] == "FAILED"){
            $payment_status = 0;
        }
        $amount = $res['amount']['value'];
        $currency = $res['amount']['currencyCode'];
        $balance_transaction = $res['reference'];
    
        $post_data = [
                        'booking_id' => $booking['bg_id'],
                        'payment_type' => 1,
                        'payment_status' => $payment_status,
                        'transcation_id' => $balance_transaction,
                        'payment_response' => json_encode($orderCreateResponse),
                        'total_payment' => $amount/100,
                        'message' => 'success',
                        'currency_code' => $currency
                ];

        //pr(json_encode($post_data)); die;
        $response =  Http::withHeaders([
                'Accept' => 'application/json',
                'domainkey' => DOMAIN_KEY
            ])->post(API_URL .'payment_update?lang='.Session::get('locale'), $post_data); 
        return redirect(app()->getLocale().'/confirmation/'.MD5($booking['booking_no']));
    }


    public function ds3($lang,$acsUrl,$TermUrl,$PaReq,$MD,$current_res,$booking_id)
    { 
         $acsUrl         = base64_decode($acsUrl);
         $TermUrl        = base64_decode($TermUrl);
         $PaReq          = base64_decode($PaReq);
         $MD             = base64_decode($MD);
         $current_res    = base64_decode($current_res);
         $booking_id            = $booking_id;
         // echo "<pre>";print_r($acsUrl);exit;
        return view('frontend.payment.ds3',compact('acsUrl','TermUrl','PaReq','MD','current_res','booking_id'));

    }
    public function checkout_post(Request $request)
    { //echo "PAYMENT_METHOD = ".PAYMENT_METHOD;exit;
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
            'ip_address'    => $request->ip()
        ]); 
        
        if(isset($response['booking_id'])) {
            // echo "<pre>";print_r($response['booking_no']);exit;
             $booking_response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'booking_details?lang='.Session::get('locale'),[
            'booking_no' => md5($response['booking_no']),
            'store_id'   => 13
            ]); 
         
                $booking = $booking_response['booking'];
                $payment_price    = $booking['total_amount'];
                $payment_currency = $booking['currency_type'];
               
                if(PAYMENT_METHOD == 'stripe'){

                try {
                
                $order_amount = round($payment_price * 100);
               
                $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

                $paymentIntent = $stripe->paymentIntents->create(
                [
                'amount' => $order_amount,
                'currency' => $payment_currency,
               // 'automatic_payment_methods' => ['enabled' => true],
                "payment_method_types" => [
                "card"
                ]
                ]
                ); 
                $payment_id = $paymentIntent->id;
                
                }
                catch (\Throwable $t) {
                custom_error_log($t->getMessage());
               // echo $t->getMessage(), " at ", $t->getFile(), ":", $t->getLine(), "\n";exit;
                }
                 catch (\Stripe\Exception\ApiErrorException $e) {
                
                custom_error_log($e->getError()->message);

                } catch (Exception $e) {

                custom_error_log($e);

                }    

                $update_payment_id =  Http::withHeaders([
                'Accept' => 'application/json',
                'domainkey' => DOMAIN_KEY
                ])->post(API_URL .'payment_create?lang='.Session::get('locale'),[
                'booking_id' => $response['booking_id'],
                'payment_method' => PAYMENT_METHOD,
                'payment_id'   => $payment_id
                ]); 

                $payment_token = $paymentIntent->client_secret;
                $booking_no    = md5($response['booking_no']);
                $payment_url = url(app()->getLocale()."/payment_success/{$booking_no}");
                $response = ["booking_id" =>$response['booking_id'],"payment_token" => $payment_token,"payment_url" => $payment_url,'payment_method' => PAYMENT_METHOD,'status' => 1];

            }
            else if(PAYMENT_METHOD == 'network'){

                try {
                $payment_token = $this->create_access_token($response['booking_id'],$booking);

                }
                catch (\Throwable $t) { 
                custom_error_log($t->getMessage());
               // echo $t->getMessage(), " at ", $t->getFile(), ":", $t->getLine(), "\n";exit;
                }
                 catch (\Stripe\Exception\ApiErrorException $e) {
                custom_error_log($e->getError()->message);
                } catch (Exception $e) {
                custom_error_log($e);
                }    


                $booking_no    = md5($response['booking_no']);
                $payment_url = url(app()->getLocale()."/card_process");
                $response = ["booking_id" => $response['booking_id'],'booking_no' => $booking_no,"payment_token" => $payment_token,"payment_url" => $payment_url,'payment_method' => PAYMENT_METHOD,'status' => 1];
            }

                return response($response, 200);
            }
        else{
            $response = ["message" => $response['message'] ,'status' => 0];
            return response($response, 200);
        }
    }


    public function create_access_token($booking_id,$booking){

                $payment_price    = $booking['total_amount'];
                $payment_currency = $booking['currency_type'];

                $apikey        = env('NETWORK_API_KEY');
                $txnServiceURL = env('NETWORK_URL')."/identity/auth/access-token";
                $tokenHeaders  = array("Authorization: Basic ".$apikey, "Content-Type: application/vnd.ni-identity.v1+json");
                //echo $txnServiceURL;exit;
                try {
                $tokenResponse = $this->invokeCurlRequest("POST", $txnServiceURL, $tokenHeaders, '');

                }
                catch (\Throwable $t) { //echo $t->getMessage();exit;
                custom_error_log($t->getMessage());
               // echo $t->getMessage(), " at ", $t->getFile(), ":", $t->getLine(), "\n";exit;
                }
                 catch (\Stripe\Exception\ApiErrorException $e) {
                custom_error_log($e->getError()->message);
                } catch (Exception $e) {
                custom_error_log($e);
                } 

                $tokenResponse = json_decode($tokenResponse);
                $access_token  = $tokenResponse->access_token;

                if(strtoupper($payment_currency) == 'GBP'){
                    $outletRef   = env('NETWORK_OUTLET_REF_GBP');
                }
                else if(strtoupper($payment_currency) == 'EUR'){
                    $outletRef   = env('NETWORK_OUTLET_REF_EUR');
                }
                else{
                    $outletRef   = env('NETWORK_OUTLET_REF_GBP');
                }
                

                $post_data = 

                array(
                'action' => 'PURCHASE',
                'amount' => array(
                'currencyCode' => strtoupper($payment_currency),
                'value' => $payment_price*100)
                )
                ;
                $order = json_encode($post_data); 

                $txnServiceURL = env('NETWORK_URL')."/transactions/outlets/".$outletRef."/orders";        
                $txnHeaders  = array("Authorization: Bearer ".$access_token, "Content-Type: application/vnd.ni-payment.v2+json", "Accept: application/vnd.ni-payment.v2+json");

                
                 try {
                $txnResponse = $this->invokeCurlRequest("POST", $txnServiceURL, $txnHeaders, $order);

                } 
                catch (\Throwable $t) {
                custom_error_log($t->getMessage());
               // echo $t->getMessage(), " at ", $t->getFile(), ":", $t->getLine(), "\n";exit;
                }
                catch (\Stripe\Exception\ApiErrorException $e) {
                custom_error_log($e->getError()->message);
                } catch (Exception $e) {
                custom_error_log($e);
                } 

                $add_token =  Http::withHeaders([
                'Accept' => 'application/json',
                'domainkey' => DOMAIN_KEY
                ])->post(API_URL .'create_network_token',[
                'booking_id' => $booking_id,
                'token' => $access_token,
                'response'   => $txnResponse
                ]); 
               // echo "<pre>";print_r($add_token['message']);exit;
                return $access_token;

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
            return redirect(app()->getLocale().'/confirmation/'.md5($booking['booking_no']));
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
       

        }
        catch (\Throwable $t) {
               // custom_error_log($t->getMessage());
             $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'payment_update?lang='.Session::get('locale'), [
                    'booking_id' => $booking['bg_id'],
                            'payment_type' => 1,
                            'payment_status' => 0,
                            'payment_response' => json_encode($t->getMessage()),
                            'message' => $t->getMessage(),
            ]); 
        }
         catch (\Stripe\Exception\ApiErrorException $e) {
     
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
        return redirect(app()->getLocale().'/confirmation/'.md5($booking['booking_no']));

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
            $old = strtotime(date("m/d/Y h:i:s ", strtotime($results['result']['current_time'])));
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

    public function invokeCurlRequest($type, $url, $headers, $post='') {

        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);     
    
        if ($type == "POST" || $type == "PUT") {
    
            curl_setopt($ch, CURLOPT_POST, 1);
            if($post != ''){
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            }
           curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        }
    
        $server_output = curl_exec ($ch);
       
        $err = curl_error($ch);
        
        curl_close($ch);
        
        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            
             return $server_output;
    
        }
    
    
    }
    
}