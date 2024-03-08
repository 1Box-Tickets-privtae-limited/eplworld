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
use Illuminate\Support\Facades\Crypt;
use Jenssegers\Agent\Agent;

use Hash;
use Session;
use Auth;
use DB;
use Stripe;

class CheckoutUrlController extends Controller
{

    public function __construct(AdyenClient $checkout)
    {
        //$this->middleware('auth');
    }


    public function checkout(Request $request,$lang)
    { 

         if(@$request->token != "" && $request->cart_id !=""){ 
            if(@$_COOKIE["partner_token"] == ""){
                $cookie_days =  time() + (86400 * 45);
                setcookie("partner_token", $request->token, $cookie_days, "/");
            }

            if(@$_COOKIE["click_ref"] == ""){
                $cookie_days =  time() + (86400 * 45);
                setcookie("click_ref", @$request->clickref, $cookie_days, "/");
            }

            $token = $request->token;   
            $match_id = base64_decode($request->m_id);  
            $ticket_id = base64_decode($request->ticket_id);    
            $cart_id = base64_decode($request->cart_id);    
            $quantity = @$request->blockquantity ? $request->blockquantity : "1";
            $reference_url = request()->headers->get('referer');    
            $click_ref = @$request->clickref;   
            $checkout_url = $request->fullUrl();    
            $cartPostData = [   
                'match_id'      => $match_id,   
                'quantity'      => $quantity,   
                'sell_ticket_id'=> $ticket_id,  
                'stadium_id'    => "11",    
                'ip'            => $_SERVER['HTTP_TRUE_CLIENT_IP'],  
                'reference_url' => $reference_url."--",  
                'click_ref'     => $click_ref."--",  
                'checkout_url'  => $checkout_url,   
                'tixstock_id'   => @$request->eid,
                'partner_token' => $token,
                'cart_id'       => $cart_id   
            ];  
            //print_r($cartPostData);
            $response =  Http::withHeaders([    
                'Accept' => 'application/json', 
                'domainkey' => DOMAIN_KEY   
            ])->post(API_URL .'cart_update_api?lang='.Session::get('locale'), $cartPostData);

            $results  = @$response['result'];
            //echo $response; die;
            if($results['status'] == 1){
                Session::put('cart_quantity', trim($quantity)); 
                Session::put('cart_id', trim($cart_id));      
                return redirect(Session::get('locale')."/checkout");
            }
            else{
                 return redirect(Session::get('locale')."/".@$response['result']['slug']);   
            }
        }
        else{
            return redirect(Session::get('locale')."/checkout");  
        }

    }

}