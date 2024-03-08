<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Client\ConnectionException;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Jenssegers\Agent\Agent;

use Hash;
use Session;
use Auth;
use DB;



class HomeController extends Controller
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

    public function index()
    {   

        try {

            $redirect = isset($_GET['redirect'])? $_GET['redirect']:"home";
            $currency = Session::get('currency');
            $response =  Http::withHeaders([
                'Accept' => 'application/json',
                'domainkey' => DOMAIN_KEY
            ])->get(API_URL .'home_v1?lang='.Session::get('locale')."&curreny=".$currency);
            //."&currency=".$currency
            $teams          = isset($response['teams'])?$response['teams']:"";
            $leagues        = isset($response['leagues'])?$response['leagues']:"";
            $cups           = isset($response['cups'])?$response['cups']:"";
            $banners        = isset($response['banners'])?$response['banners']:"";
// echo '<pre/>';
// print_r($leagues);
// exit;
            // $top_teams      = isset($response['top_teams'])?$response['top_teams']:"";
            // $top_matchs     = isset($response['top_matchs'])?$response['top_matchs']:"";
            // $upcoming       = isset($response['upcoming'])?$response['upcoming']:"";
            // $tournaments    = isset($response['tournaments'])?$response['tournaments']:"";
            $agent = new Agent();
            $mobile  = $agent->isMobile();
            $layout =  "frontend.index";
            //return view($layout,compact('teams','leagues','cups','banners','top_matchs','top_teams','upcoming','tournaments'));
            $homepage = "homepage";
            return view($layout,compact('teams','leagues','cups','banners','redirect','homepage'));
        }
             catch(ConnectException $e)
        {
            //log error
        }
    }
    
    public function index_sep21()
    {   
        try {

            $redirect = isset($_GET['redirect'])? $_GET['redirect']:"home";
            $currency = Session::get('currency');
            $response =  Http::withHeaders([
                'Accept' => 'application/json',
                'domainkey' => DOMAIN_KEY
            ])->get(API_URL .'home_v1?lang='.Session::get('locale')."&currency=".$currency);
            $teams          = isset($response['teams'])?$response['teams']:"";
            $leagues        = isset($response['leagues'])?$response['leagues']:"";
            $cups           = isset($response['cups'])?$response['cups']:"";
            $banners        = isset($response['banners'])?$response['banners']:"";
            // $top_teams      = isset($response['top_teams'])?$response['top_teams']:"";
            // $top_matchs     = isset($response['top_matchs'])?$response['top_matchs']:"";
            // $upcoming       = isset($response['upcoming'])?$response['upcoming']:"";
            // $tournaments    = isset($response['tournaments'])?$response['tournaments']:"";
            $agent = new Agent();
            
            $mobile  = $agent->isMobile();
            $layout =  "frontend.index";
            //return view($layout,compact('teams','leagues','cups','banners','top_matchs','top_teams','upcoming','tournaments'));
            $homepage = "homepage";
            return view($layout,compact('teams','leagues','cups','banners','redirect','homepage'));
        }
             catch(ConnectException $e)
        {
            //log error
        }
    }

     public function request_ticket_google(Request $request,$lang){
       
         $status = $request->status;
         $match = @$match;
          $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'match_details?lang='.Session::get('locale')."&currency=".Session::get('currency'), [
                        'slug'=> $match,
                    ]);
        $results            = @$response['result'];
        //echo "<pre>";print_r($results);exit;
        $tournament         = @$results['t_id'];
       /* $email         = @$results['email_id'];
        $phone_no         = @$results['diallingcode'].' '.$results['mobilenumber'];*/
        $tournament_url_key = @$results['tournament_url_key'];
        $title = "Thank You";
         return view("frontend.general.request_ticket_ajax",compact('match','status','tournament','tournament_url_key','title'/*,'email','phone_no'*/));
    }
    public function get_state(Request $request)
    {
        $states_response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'state',['country_id' =>$request->country_id ]);
        $states = $states_response['results'];
        return response($states,200);
    }

    public function subscribe(Request $request)
    { 
        $subscribe =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'subscribe',['email' =>$request->email ]);
        return response($subscribe, 200);
    }

    public function partnership(Request $request)
    {
        $title =  __('messages.partnership title');
        $description =  "";
        $country_response = Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->get(API_URL .'country?lang='.Session::get('locale')."&sort_by=name");
        $country          = $country_response['results'];
        return view('frontend.general.partnership',compact('title','description','country'));
    }

    public function sell_ticket(Request $request)
    {
        $title =  __('messages.partnership title');
        $description =  "";
        $country_response = Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->get(API_URL .'country?lang='.Session::get('locale')."&sort_by=name");
        $country          = $country_response['results'];
        return view('frontend.general.sell_ticket',compact('title','description','country'));
    }
  
     public function search_data(Request $request)
    {
       
        $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'home_search?lang='.Session::get('locale'),['keywords' =>$request->teamname ]);

        $results = $response['results'];
        return response($results,200);
    }

}