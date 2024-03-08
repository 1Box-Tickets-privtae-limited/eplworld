<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Stripe;
use Session;

class ConfirmationController extends Controller
{
    public function index($lang,$ref_no)
    {
        
       if (!$ref_no) {

            $booking_response['booking']['error'] = "Invalid Booking Reference Number.";
       }
       else{ 

             $booking_response =  Http::withHeaders([
                    'Accept' => 'application/json',
                    'domainkey' => DOMAIN_KEY
                ])->post(API_URL .'booking_details?lang='.Session::get('locale'),[
                    'booking_no' => $ref_no,
            ]); 
         }
        $booking = $booking_response['booking'];
       //  echo "<pre>";print_r($booking);exit;
        //return view('frontend.checkout.confirmation')->with(['data'=>$booking_response]);
        $title =  "Confirmation Ticket";
        $description =  "Confirmation Ticket";
         return view('frontend.checkout.confirmation',compact('booking','title','description'));
    }

    public function failed($lang,$ref_no)
    {
        
       if (!$ref_no) {

            $booking_response['booking']['error'] = "Invalid Booking Reference Number.";
       }
       else{ 

             $booking_response =  Http::withHeaders([
                    'Accept' => 'application/json',
                    'domainkey' => DOMAIN_KEY
                ])->post(API_URL .'booking_details?lang='.Session::get('locale'),[
                    'booking_no' => $ref_no,
            ]); 
         }
        $booking = $booking_response['booking'];
       //  echo "<pre>";print_r($booking);exit;
        //return view('frontend.checkout.confirmation')->with(['data'=>$booking_response]);
        $title =  "Failed Ticket";
        $description =  "Failed Ticket";
         return view('frontend.checkout.failed',compact('booking','title','description'));
    }
}
