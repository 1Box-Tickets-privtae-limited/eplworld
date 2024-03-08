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
use NoCaptcha;


class GeneralController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function terms_conditions() 
    {
        $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'page?page_name=Terms and Conditions&lang='.Session::get('locale'));

        $results = $response['result'];
        $title =  __('messages.terms & conditions');
        $description =  __('messages.terms & conditions');

        // if(Session::get('locale')  == 'ar'){
        //     $file_name = 'frontend.general.terms_condition_ar';
        // }
        // else{
            $file_name = 'frontend.general.terms_condition';
        //}
        return view($file_name,compact('title','results'));
    }
    public function privacy_policy() 
    {
        $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'page?page_name=Privacy policy&lang='.Session::get('locale'));
        $results = $response['result'];
        $title =  __('messages.privacy policy');
        $description =  __('messages.privacy policy');
        return view('frontend.general.privacy_policy',compact('results','title','description'));
    }

    public function about_us() 
    {
        $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'page?page_name=About us&lang='.Session::get('locale'));
        $results = $response['result'];
        $title =  __('messages.about us');
        $description =  __('messages.about us');
        return view('frontend.general.about_us',compact('results','title','description'));
    }

    public function language_set(Request $request)
    {   
        if($request->lang){
            switch($request->lang){
                case "ENG": $lang  = "en";break;
                case "FRA": $lang  = "ar";break;
                default: $lang = "en";
            } 
            Session::put('locale', $lang);
            $response = ["message" => "Success",'status' => 1];
            return response($response, 200);
        }
        else{
            $response = ["message" => $result['message'] ,'status' => 0];
            return response($response, 200);
        }
    }

    public function set_currency(Request $request)
    {   
        if($request->lang){
            if($request->lang == "EUR" ||  $request->lang  == "GBP")
            {
                Session::put('locale', $request->lang);
                $response = ["message" => "Success",'status' => 1];
                return response($response, 200);}
        }
        else{
            $response = ["message" => $result['message'] ,'status' => 0];
            return response($response, 200);
        }
    }

    public static  function get_settings()
    {
        
        $domain_key = $_SERVER['SERVER_NAME'];
        $file_name = "settings-".$domain_key.".json";
        if (!file_exists($file_name)) {
           $fh = fopen($file_name, 'w');
           
        }

        $file_name_ar = "settings-".$domain_key."-ar.json";
        if (!file_exists($file_name_ar)) {
           $fh = fopen($file_name_ar, 'w');
            
        }



        $response =  Http::withHeaders([
                    'Accept' => 'application/json',
                    'domainkey' => DOMAIN_KEY
                ])->get(API_URL .'setting?lang=en');
        $results = $response['results'];
       
        $fp = fopen($file_name,"wb");
        fwrite($fp,json_encode($results));
        fclose($fp);
        
        $response_ar =  Http::withHeaders([
                    'Accept' => 'application/json',
                    'domainkey' => DOMAIN_KEY
                ])->get(API_URL .'setting?lang=en');
        $results_ar = $response_ar['results'];
        $fp_ar = fopen($file_name_ar,"wb");
        fwrite($fp_ar,json_encode($results_ar));
        
    }

    public function countries()
    {
        $country_response = Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->get(API_URL .'country?lang='.Session::get('locale'));
        $country          = $country_response['results'];
        return response($country,200);
    }

    public function events(){
        $event_response   = Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->get(API_URL .'match_list?lang='.Session::get('locale'));
        $events = $event_response['results'];
        return response($events,200);
    }

    public function single_events(Request $request){
        $event_id = $request->event_id;
        $event_response   = Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->get(API_URL .'match_single_list?lang='.Session::get('locale')."&event_id=".$event_id);
        $events = $event_response['results'];
        return response($events,200);
    }

    public function partnership_enquiry(Request $request)
    {   //pr($request->all());die;
        $request->validate([
            'g-recaptcha-response' => 'required|captcha',
        ], 
        [], 
        [
             'g-recaptcha-response' => 'Captcha'
        ]);
        NoCaptcha::shouldReceive('verifyResponse')
            ->once()
            ->andReturn(true);
        
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'partner_enquriy?lang='.Session::get('locale'), [
                        'first_name' => $request->post('firstname'),
                        'last_name'  => $request->post('lastname'),
                        'email'      => $request->post('email'),
                        'mobile_no'  => $request->post('mobile_number'),
                        'organization_name' => $request->post('organization'),
                        'website'    => $request->post('website'),
                        'country'    => $request->post('country'),
                        'message'    => $request->post('message'),
                    ]);
        if($response['status'] == 1)
        {
            if(@$request->post('sell_ticket') == 1){
                 Session::flash('success', $response['message']);
                return redirect(app()->getLocale().'/sell-your-tickets');
            }
            else{
                 Session::flash('success', $response['message']);
            return redirect(app()->getLocale().'/partnership');
            }
           
        }
        else{
            if(@$request->post('sell_ticket') == 1){
                 Session::flash('success', $response['message']);
                return redirect(app()->getLocale().'/sell-your-tickets');
            }
            else{
                Session::flash('success', $response['message']);
                return redirect(app()->getLocale().'/partnership');
            }
        }
        
    }

    public function faq_help(Request $request)
    {
        $title =  __('messages.faq');
        $description =  __('messages.faq');
        return view('frontend.general.faq_help',compact('title','description'));
    }

    public function unsubscribe(Request $request)
    {
        if($request->post('_token')){

             $request->validate([
                'email' => 'required|email'
            ]);
            $response = Http::withHeaders([
                            'Accept' => 'application/json',
                            'domainkey' => DOMAIN_KEY
                        ])->post(API_URL .'unsubscribe?lang='.Session::get('locale'), [
                            'email' => $request->post('email'),
                            'reason'  => $request->post('reason'),
                        ]);
            $results = $response;
            if($results['status'] == 1)
            {
                Session::flash('success', $results['message']);
                return redirect(app()->getLocale().'/unsubscribe');
            }
            else{
                Session::flash('error', $results['message']);
                return redirect(app()->getLocale().'/unsubscribe');
            }
        }else{
            $title="UnSubscribe";
            return view('frontend.general.unsubscribe',compact('title'));
        }
    }

    public function advance_search(Request $request)
    {
        $title =  __('messages.advance search title');
        $description =  "";
        if(!empty($request->post('_token'))){
            
            $limit = $request->limit ? $request->limit : 10;
            $page = $page = $request->page ? $request->page : 1;

            $response =  Http::withHeaders([
                            'Accept' => 'application/json',
                            'domainkey' => DOMAIN_KEY
                        ])->post(API_URL .'advance_search?lang='.Session::get('locale').'&currency='.Session::get('currency'), [
                        'keywords'        => $request->post('keywords'),
                        'country'         => $request->post('country'),
                        'tournament'      => $request->post('tournament'),
                        'from_date'       => $request->post('start_date'),
                        'to_date'         => $request->post('end_date'),
                        'sort_by'         => $request->post('sort_by'),
                        'date'            => $request->post('date'),
                        "stadium"         => $request->post('stadium'),
                        "teams"           => @$request->post('teams'),
                        "city"            => $request->post('city'),
                        "limit"           => $limit,
                        "page"            => $page,
                    ]); 
           
            $results = $response['results'];
            $returnHTML = view('frontend.ajax.advance_search',compact('results','page'))->render();
            return response()->json( array('success' => true, 'html'=>$returnHTML) );
        }else {
            $country_list   =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->get(API_URL .'match_country');
            $country        = $country_list['results'];

            $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->get(API_URL .'get_tournament?lang='.Session::get('locale')."&currency=".Session::get('currency'));

             $tournaments = $response['results'];
            $team_lists_lists =  Http::withHeaders([
                'Accept' => 'application/json',
                'domainkey' => DOMAIN_KEY
            ])->get(API_URL .'team_list?lang='.Session::get('locale')."&currency=".Session::get('currency'));
         
            $team_lists = $team_lists_lists['results'];
            return view('frontend.general.search',compact('title','country','tournaments','description','team_lists'));
        }
        
    }

    /*public function terms_conditions(Request $request)
    {
        $title="Terms & conditions";
        return view('frontend.general.terms_condition',compact('title'));
    }*/

    public function contact_us(Request $request)
    {
        $country_response = Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->get(API_URL .'country?lang='.Session::get('locale'));
        $country          = $country_response['results'];
        if($request->post('_token')){
            $request->validate([
                'g-recaptcha-response' => 'required|captcha',
            ],[], 
            ['g-recaptcha-response' => 'Captcha']);

            NoCaptcha::shouldReceive('verifyResponse')
            ->once()
            ->andReturn(true);

            $response = Http::withHeaders([
                            'Accept' => 'application/json',
                            'domainkey' => DOMAIN_KEY
                        ])->post(API_URL .'contact?lang='.Session::get('locale'), [
                            'first_name' => $request->post('firstname'),
                            'last_name'  => $request->post('lastname'),
                            'email'      => $request->post('email'),
                            'mobile_no'  => $request->post('mobile_number'),
                            'country'    => $request->post('country'),
                            'message'    => $request->post('message'),
                            'dialing_code'=> $request->post('dialing_code'),
                        ]);
             //echo $response;die;
            $results = $response['result'];
            if($results['status'] == 1)
            {
                Session::flash('success', $results['message']);
                return redirect(app()->getLocale().'/contact-us');
            }
            else{
                Session::flash('error', $results['message']);
                return redirect(app()->getLocale().'/contact-us');
            }
        }else{
            $title =  __('messages.contact us');
            $description =  __('messages.contact us');
            return view('frontend.general.contact_us',compact('title','country','description'));
        }
        
    }

}
