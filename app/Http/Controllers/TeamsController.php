<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
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


class TeamsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function top_teams(Request $request)
    { 
        $title =   __('messages.top team title');
        $description = "";
        return view('frontend.teams.top_teams',compact('title','description'));
    }

      public function trackorder(Request $request)
    { 
        $title =   __('messages.trackorder title');
        $description = "";
        return view('frontend.teams.trackorder',compact('title','description'));
    }
    public function track_order_details(Request $request) 
    {


        if($request->order_id && $request->email && $request->surname){
           

         $postdata = [
                        'order_id'  => $request->order_id,
                        'email'     => $request->email,
                        'surname'   => $request->surname,
                    ];
        //pr($postdata);die;
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'tracking_details?lang='.Session::get('locale'), $postdata);

       
            $results = @$response['booking'];
            //pr($results);die;
            $returnHTML = view('frontend.ajax.tracking_details',compact('results'))->render();
            return response()->json( array('success' => true, 'html'=>$returnHTML,'status' => 1) );
        }
        else{
            $results = "";
            $returnHTML = view('frontend.ajax.tracking_details',compact('results'))->render();
            return response()->json( array('success' => true, 'html'=>$returnHTML,'status' => 0) );
        }

        return view('frontend.general.track_order',compact('title','description'));
    }
    
    public function all_teams(Request $request)
    { 
        $title =  __('messages.teams title');
        $description = "";
        $country_list   =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->get(API_URL .'match_country');
        $country        = isset($country_list['results'])?$country_list['results']:"";
        return view('frontend.teams.all_teams',compact('country','title','description'));
    }

    public function tournaments(Request $request)
    { 
        $title = __('messages.tournaments title');
        $description = "";
        return view('frontend.teams.tournament',compact('title','description'));
    }

    public function other_events(Request $request)
    {
        $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->get(API_URL .'other_events?lang='.Session::get('locale')."&currency=".Session::get('currency'));

        $results = $response['results'];
        $title = __('messages.other tickets');
        $description = __('messages.other tickets');
        return view('frontend.teams.other_events',compact('results','title','description'));
    }

    public function teams_list(Request $request)
    { 
        $title = __('messages.all teams');
        $description =  __('messages.all teams');

        $filter['lang'] = Session::get('locale');
        $filter['currency'] = Session::get('currency');

        $filter['limit'] = $request->limit ? $request->limit : 10000;
        $filter['page'] = $page = $request->page ? $request->page : 1;

        $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->get(API_URL .'get_teams?',http_build_query($filter));
        
        $results        = isset($response['results'])?$response['results']:"";
        return view('frontend.teams.teams_list',compact('title','description','results'));
    }

    public function team_ticket(Request $request)
    {   
        $team_name  = $request->team_name;
        $type       = $request->type;
        $search     = $request->search;
        if($team_name){
           $team_name = $team_name.'-tickets'; 
        }
       // echo $team_name;exit;
       // echo API_URL .'team_ticket/'.$team_name.'/'.$type.'?lang='.Session::get('locale').'&keywords='.$search."&currency=".Session::get('currency');exit;
        $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->get(API_URL .'team_ticket/'.$team_name.'/'.$type.'?lang='.Session::get('locale').'&keywords='.$search."&currency=".Session::get('currency'));
        $team    = $response['team'];//echo "<pre>";print_r($team);exit;
        $results = $response['result'];
        $title = @$response['team']['page_title'];
        $description = @$response['team']['meta_description'];

        return view('frontend.teams.team_tickets',compact('results','team','team_name','type','title','description'));
    }
    
    public function match_details(Request $request,$lang,$tema,$teamb)
    {   
        $sourcetype =  @$request->sourcetype ;
        $match_name = $tema.'-vs-'.$teamb;
        $match_name_arr = explode('-',$match_name);
        if($match_name_arr[0] == 'other' && $match_name_arr[1] == "events"){

             $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'other_match_details?lang='.Session::get('locale')."&currency=".Session::get('currency'), [
                        'slug'=> $match_name,
                    ]);

        /*if($match_name == "premier-league-brentford-fc-vs-manchester-united-tickets"){
            echo "<pre>";print_r($response['result']);exit;
        }*/

        if($response->status()  == 422){
            $title =  "Page Not Found";
            $description = "";
            return response()->view('errors.' . '404', [$title,$description], 404);
        }
        $results  = $response['result'];
        $prices   = $response['price'];
        $category = $response['category_list'];
        $ticketQuantity = $response['quantity'];
        $seatList = $response['seat_list'];

        if((@$results['tournament_name'] == "World Cup Qatar 2022"  || @$results['tournament_name'] == "كأس العالم قطر 2022")  && Session::get('currency') != "USD"  )
        {
           Session::put('currency', "USD");
           return redirect(Session::get('locale')."/".$match_name);
        }
        
        $set_stadium_blocks = $response['set_stadium_blocks'];
        $set_active_stadium_blocks = @$response['set_active_stadium_blocks'];
        $full_block_data = $response['full_block_data'];
        $set_stadium_blocks_with_cat = $response['set_stadium_blocks_with_cat'];
        $set_stadium_cat_name = $response['set_stadium_cat_name'];
        $ticket_price_info  = $response['ticket_price_info'];
        $ticket_price_info_with_cat = $response['ticket_price_info_with_cat'];

        $title =  $results['meta_title'] ? $results['meta_title'] : $results['match_name'];
        $description =  $results['meta_description'] ? $results['meta_description'] : $results['match_name'];
        $team_names = explode("vs",$results['match_name']);

        return view('frontend.teams.oe_ticket_selection',compact('results','prices','category','ticketQuantity','seatList','set_stadium_blocks','set_stadium_blocks_with_cat','set_stadium_cat_name','ticket_price_info','ticket_price_info_with_cat',
            'full_block_data','title','description','team_names','set_active_stadium_blocks'));


        }
        else{

             $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'match_details?lang='.Session::get('locale')."&currency=".Session::get('currency'), [
                        'slug'=> $match_name,
                        'sourcetype'    => $sourcetype
                    ]);

        if($match_name == "world-cup-2022-saudi-arabia-vs-argentina-tickets"){
             return redirect(Session::get('locale')."/World-Cup-2022-tickets?team=195");
        }
        if($match_name == "premier-league-arsenal-vs-leeds-united-tickets-1623856360"){
             return redirect(Session::get('locale')."/premier-league-arsenal-vs-leeds-united-tickets1");
        }

        if($response->status()  == 422){
            if(@$tema){
                  return redirect(Session::get('locale')."/".$tema."-tickets");
            }
            else{
                $title =  "Page Not Found";
                $description = "";
                return response()->view('errors.' . '404', [$title,$description], 404);
            }
        }
        $results  = $response['result'];
        $prices   = $response['price'];
        $category = $response['category_list'];
        $ticketQuantity = $response['quantity'];

        $stadium_type = @$response['stadium_type'] ? $response['stadium_type'] : 1;



        if($stadium_type == 1){

            $seatList = $response['seat_list'];
            $set_stadium_blocks = $response['set_stadium_blocks'];
            $set_active_stadium_blocks = @$response['set_active_stadium_blocks'];
            $full_block_data = $response['full_block_data'];
            $set_stadium_blocks_with_cat = $response['set_stadium_blocks_with_cat'];
            $set_stadium_cat_name = $response['set_stadium_cat_name'];
            $ticket_price_info  = $response['ticket_price_info'];
            $ticket_price_info_with_cat = $response['ticket_price_info_with_cat'];

        }
        else{
             $stadium = $response['stadium'];
        }

        
        

        $title =  $results['meta_title'] ? $results['meta_title'] : $results['match_name'];
        $description =  $results['meta_description'] ? $results['meta_description'] : $results['match_name']." | ".$results['tournament_name']." | ".$results['match_date'];

        //Team 1 vs Team 2 Tickets | Tournament name | Date of Event | 1BoxOffice.com

        $agent = new Agent();
        $mobile  = $agent->isMobile();
        $mobile_view = $mobile ==  true ?  "1"  : "0";
        if($stadium_type == 1){
                 return view('frontend.teams.ticket_selection',compact('results','prices','category','ticketQuantity','seatList','set_stadium_blocks','set_stadium_blocks_with_cat','set_stadium_cat_name','ticket_price_info','ticket_price_info_with_cat',
                'full_block_data','title','description','mobile_view','set_active_stadium_blocks'));

        }
        else{

                return view('frontend.teams.ticket_selection_new',compact('results','prices','category','ticketQuantity','stadium','title','description','mobile_view'));
        }


        }

        

    }

    public function test_match_details(Request $request,$lang,$tema,$teamb)
    {   
        
        $match_name = $tema.'-vs-'.$teamb;
        $match_name_arr = explode('-',$match_name);
        if($match_name_arr[0] == 'other' && $match_name_arr[1] == "events"){

             $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'other_match_details?lang='.Session::get('locale')."&currency=".Session::get('currency'), [
                        'slug'=> $match_name,
                        'page_type' => 'test'
                    ]);

        /*if($match_name == "premier-league-brentford-fc-vs-manchester-united-tickets"){
            echo "<pre>";print_r($response['result']);exit;
        }*/

        if($response->status()  == 422){
            $title =  "Page Not Found";
            $description = "";
            return response()->view('errors.' . '404', [$title,$description], 404);
        }
        $results  = $response['result'];
        $prices   = $response['price'];
        $category = $response['category_list'];
        $ticketQuantity = $response['quantity'];
        $seatList = $response['seat_list'];

        if((@$results['tournament_name'] == "World Cup Qatar 2022"  || @$results['tournament_name'] == "كأس العالم قطر 2022")  && Session::get('currency') != "USD"  )
        {
           Session::put('currency', "USD");
           return redirect(Session::get('locale')."/".$match_name);
        }
        
        $set_stadium_blocks = $response['set_stadium_blocks'];
        $set_active_stadium_blocks = @$response['set_active_stadium_blocks'];
        $full_block_data = $response['full_block_data'];
        $set_stadium_blocks_with_cat = $response['set_stadium_blocks_with_cat'];
        $set_stadium_cat_name = $response['set_stadium_cat_name'];
        $ticket_price_info  = $response['ticket_price_info'];
        $ticket_price_info_with_cat = $response['ticket_price_info_with_cat'];

        $title =  $results['meta_title'] ? $results['meta_title'] : $results['match_name'];
        $description =  $results['meta_description'] ? $results['meta_description'] : $results['match_name'];
        $team_names = explode("vs",$results['match_name']);

        return view('frontend.teams.oe_ticket_selection',compact('results','prices','category','ticketQuantity','seatList','set_stadium_blocks','set_stadium_blocks_with_cat','set_stadium_cat_name','ticket_price_info','ticket_price_info_with_cat',
            'full_block_data','title','description','team_names','set_active_stadium_blocks'));


        }
        else{

             $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'match_details?lang='.Session::get('locale')."&currency=".Session::get('currency'), [
                        'slug'=> $match_name,
                        'page_type' => 'test'
                    ]);

        if($match_name == "world-cup-2022-saudi-arabia-vs-argentina-tickets"){
             return redirect(Session::get('locale')."/World-Cup-2022-tickets?team=195");
        }

        if($response->status()  == 422){
            $title =  "Page Not Found";
            $description = "";
            return response()->view('errors.' . '404', [$title,$description], 404);
        }
        $results  = $response['result'];
        $prices   = $response['price'];
        $category = $response['category_list'];
        $ticketQuantity = $response['quantity'];
        $seatList = $response['seat_list'];

        if(($results['tournament_name'] == "World Cup Qatar 2022"  || $results['tournament_name'] == "كأس العالم قطر 2022")  && Session::get('currency') != "USD"  )
        {
           Session::put('currency', "USD");
           return redirect(Session::get('locale')."/".$match_name);
        }
        
        $set_stadium_blocks = $response['set_stadium_blocks'];
        $set_active_stadium_blocks = @$response['set_active_stadium_blocks'];
        $full_block_data = $response['full_block_data'];
        $set_stadium_blocks_with_cat = $response['set_stadium_blocks_with_cat'];

        $set_stadium_cat_name = $response['set_stadium_cat_name'];
        $ticket_price_info  = $response['ticket_price_info'];
        $ticket_price_info_with_cat = $response['ticket_price_info_with_cat'];

        $title =  $results['meta_title'] ? $results['meta_title'] : $results['match_name'];
        $description =  $results['meta_description'] ? $results['meta_description'] : $results['match_name'];
        $agent = new Agent();
        $mobile  = $agent->isMobile();
        $mobile_view = $mobile ==  true ?  "1"  : "0";
        return view('frontend.teams.test_ticket_selection',compact('results','prices','category','ticketQuantity','seatList','set_stadium_blocks','set_stadium_blocks_with_cat','set_stadium_cat_name','ticket_price_info','ticket_price_info_with_cat',
            'full_block_data','title','description','mobile_view','set_active_stadium_blocks'));

        }

        

    }


    public function other_details(Request $request,$lang,$event_name)
    {   
    

        $response =  Http::withHeaders([
                    'Accept' => 'application/json',
                    'domainkey' => DOMAIN_KEY
                ])->post(API_URL .'other_match_details?lang='.Session::get('locale')."&currency=".Session::get('currency'), [
                    'slug'=> $event_name,
                ]);
       
        /*if($match_name == "premier-league-brentford-fc-vs-manchester-united-tickets"){
            echo "<pre>";print_r($response['result']);exit;
        }*/

        if($response->status()  == 422){
            $title =  "Page Not Found";
            $description = "";
            return response()->view('errors.' . '404', [$title,$description], 404);
        }
        $results  = $response['result'];
        $prices   = $response['price'];
        $category = $response['category_list'];
        $ticketQuantity = $response['quantity'];
        $seatList = $response['seat_list'];

        if((@$results['tournament_name'] == "World Cup Qatar 2022"  || @$results['tournament_name'] == "كأس العالم قطر 2022")  && Session::get('currency') != "USD"  )
        {
           Session::put('currency', "USD");
           return redirect(Session::get('locale')."/".$match_name);
        }
        
        $set_stadium_blocks = $response['set_stadium_blocks'];
        $full_block_data = $response['full_block_data'];
        $set_stadium_blocks_with_cat = $response['set_stadium_blocks_with_cat'];
        $set_stadium_cat_name = $response['set_stadium_cat_name'];
        $ticket_price_info  = $response['ticket_price_info'];
        $ticket_price_info_with_cat = $response['ticket_price_info_with_cat'];

        $title =  $results['meta_title'] ? $results['meta_title'] : $results['match_name'];
        $description =  $results['meta_description'] ? $results['meta_description'] : $results['match_name'];
        $team_names = explode("vs",$results['match_name']);

        return view('frontend.teams.oe_ticket_selection',compact('results','prices','category','ticketQuantity','seatList','set_stadium_blocks','set_stadium_blocks_with_cat','set_stadium_cat_name','ticket_price_info','ticket_price_info_with_cat',
            'full_block_data','title','description','team_names'));

    }

    public function team_leagues(Request $request,$lang,$team_leagu,$type="")
    {  
        $team_leagu_name    = $team_leagu.'-tickets';
        $search_keyword     = $request->search ? $request->search : "";
        $type               = $request->type ? $request->type : "";
       //echo $team_leagu_name;exit;

        $month="";
        if(!empty($request->get('month'))){
            $month = $request->get('month');
        }

        $selected_team="";
        if(!empty($request->get('team'))){
            $selected_team = $request->get('team');
        }

        $selected_tournment="";
        if(!empty($request->get('tournament'))){
            $selected_tournment = $request->get('tournament');
        }

        $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'team_leagues?lang='.Session::get('locale')."&currency=".Session::get('currency'), [
                        'team_leagu_name'          => $team_leagu_name,
                        'keywords'                 => $search_keyword,
                        'month'                    => $month,
                        'team'                    => $selected_team,
                        'tournment'                => $selected_tournment,
                        'type'                     => $type
                    ]);
        // echo API_URL .'team_leagues?lang='.Session::get('locale')."&currency=".Session::get('currency');
        // echo "<br>";
        // echo $team_leagu_name;
        // echo @$response;die;
       
        if(@$response['data_type'] == 'team'){
            $team_name = $team_leagu; 
            $team    = $response['team'];//echo "<pre>";print_r($team);exit;
            $results = $response['result']; 
            $top_teams = $response['top_teams'];
            $tournaments = $response['tournaments'];
            $title = @$response['team']['page_title'] ? @$response['team']['page_title'] : $team['team_name'];
            $description = @$response['team']['meta_description']  ? @$response['team']['meta_description'] : $team['team_name'];
            if($type != ''){
                $type_name ="";
                if($type == "all"){
                    $type_name = __('messages.all tickets');
                }  
                else if($type == "home"){
                    $type_name = __('messages.home tickets');
                }
                else if($type == "away"){
                    $type_name = __('messages.away tickets');
                }
                $title =  @$team['team_name']." ".$type_name;
                $description =  @$team['team_name']." ".$type_name;
            }
            if($type=="ajax"){
                $returnHTML = view('frontend.ajax.team_tickets',compact('results','team','team_name','type','title','description','selected_tournment'))->render();
                return response()->json( array('success' => true, 'html'=>$returnHTML) );
            }

           
            return view('frontend.teams.team_tickets',compact('results','team','team_name','type','title','description','tournaments','selected_tournment','top_teams'));
        }
        else if(@$response['data_type'] == 'tournament'){

            $results       = $response['result'];
            $tournament    = $response['tournament'];
            $teams         = $response['teams'];
            $default_teams = $response['default_teams'];
            $features_match = @$response['features_match'];

            if(($tournament['tournament_name'] == "World Cup Qatar 2022"  || $tournament['tournament_name'] == "كأس العالم قطر 2022")  && Session::get('currency') != "USD"  )
            {
               Session::put('currency', "USD");
               return redirect(Session::get('locale')."/".$team_leagu_name);
            }
            
            /* Generating month */
            $months = array();
            for ($i=idate('m'); $i <=  12; $i++ ){
            $months[$i] = date("F", mktime(0, 0, 0, $i, 10)) ;
            }
            $agent = new Agent();
            $mobile  = $agent->isMobile();
            $title = @$tournament['page_title'] ? @$tournament['page_title'] : $tournament['tournament_name'];
            $description = @$tournament['meta_description'] ? @$tournament['meta_description']  : $tournament['tournament_name'] ;
            return view('frontend.teams.tournaments_leagues',compact('results','tournament','teams','months','title','description','selected_team','default_teams','mobile','features_match'));

        }
        
    }
  
    public function request_ticket(Request $request)
    { 
        $country_response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->get(API_URL .'country?lang='.Session::get('locale'));
        $country = $country_response['results'];
        
        $event_response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->get(API_URL .'match_list?lang='.Session::get('locale'));
        $events = $event_response['results'];
        $requestId = base64_decode($request->id);
        return view('frontend.teams.request_ticket',compact('country','events','requestId'));
    }

    /*public function request_ticket_post(Request $request)
    { 
        $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'request_ticket?lang='.Session::get('locale'), [
            'event_id'          => $request->post('event_id'),
            'user_id'           => Session::get('user_id'),
            'country'           => $request->post('country'),
            'category'          => $request->post('category'),
            'quantity'          => $request->post('quantity'),
            'special_request'   => $request->post('special_request'),
            'request_type'      => $request->post('request_type'),
            'full_name'         => $request->post('full_name'),
            'email'             => $request->post('email'),
            'dialling_code'     => $request->post('dialing_code'),
            'mobile_number'     => $request->post('phone'),
        ]);

        if(isset($response['request_id'])) {
            $response = ["message" => $response['message'],'status' => 1];
            return response($response, 200);
        }
        else{
            $response = ["message" => $response['message'],'status' => 0];
            return response($response, 200);
        }
    }*/

    public function request_ticket_post(Request $request)
    { 
        $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'request_ticket?lang='.Session::get('locale'), [
            'event_id'          => $request->post('event_id'),
            'tournment'          => $request->post('tournment'),
            'user_id'           => Session::get('user_id'),
            'country'           => $request->post('country'),
            'category'          => $request->post('category'),
            'quantity'          => $request->post('quantity'),
            'special_request'   => $request->post('special_request'),
            'request_type'      => $request->post('request_type'),
            'full_name'         => $request->post('full_name'),
            'email'             => $request->post('email'),
            'dialling_code'     => $request->post('dialing_code'),
            'mobile_number'     => $request->post('phone'),
        ]);

        if(isset($response['request_id'])) {
            $response = ["message" => $response['message'],'status' => 1,'match' => $request->post('tournment'),'email' => $response['email'],'phone_number' => $response['phone_number']];
            return response($response, 200);
        }
        else{
            $response = ["message" => $response['message'],'status' => 0,'match' => $request->post('tournment')];
            return response($response, 200);
        }
    }



    public function tournaments_leagues(Request $request)
    { 
        $month="";
        if(!empty($request->get('month'))){
            $month = "&month=".$request->get('month');
        }
        $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'tournament?lang='.Session::get('locale')."&currency=".Session::get('currency').$month, [
                        'tournament_url'          => $request->type,
                    ]);

        $results       = $response['result'];
        $tournament    = $response['tournament'];
        $teams         = $response['teams'];
    
        /* Generating month */
        $months = array();
        for ($i=idate('m'); $i <=  12; $i++ ){
            $months[$i] = date("F", mktime(0, 0, 0, $i, 10)) ;
        }
        $title = @$tournament['page_title'];
        $description = @$tournament['meta_description'];
        return view('frontend.teams.tournaments_leagues',compact('results','tournament','teams','months','title','description'));
    }

    public function ticket_details(Request $request)
    {
        $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'match_details?lang='.Session::get('locale')."&currency=".Session::get('currency'), [
                        'slug'=> $request->team,
                    ]);
        $results  = $response['result'];
        $prices   = $response['price'];
        $category = $response['category_list'];
        $ticketQuantity = $response['quantity'];
        $seatList = $response['seat_list'];
        
        $set_stadium_blocks = $response['set_stadium_blocks'];
        $full_block_data = $response['full_block_data'];
        $set_stadium_blocks_with_cat = $response['set_stadium_blocks_with_cat'];
        $set_stadium_cat_name = $response['set_stadium_cat_name'];
        $ticket_price_info  = $response['ticket_price_info'];
        $ticket_price_info_with_cat = $response['ticket_price_info_with_cat'];

        $title =  $results['meta_title'];
        $description =  $results['meta_description'];

        return view('frontend.teams.ticket_selection',compact('results','prices','category','ticketQuantity','seatList','set_stadium_blocks','set_stadium_blocks_with_cat','set_stadium_cat_name','ticket_price_info','ticket_price_info_with_cat',
            'full_block_data','title','description'));

    }

    public function category_list(Request $request)
    {
        $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'category_list?lang='.Session::get('locale')."&currency=".Session::get('currency'), [
            'match_id'=> $request->match_id,
        ]);
       // echo $response;
     
        $results  = $response['results'];
        return response($results,200);
    }

    public function top_games(Request $request)
    {
        $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->get(API_URL .'top_matchs?lang='.Session::get('locale')."&currency=".Session::get('currency'));
        $results = $response['top_matchs'];
        $title =   __('messages.all top teams'); 
        $description =   __('messages.all top teams');
        return view('frontend.teams.top_games',compact('results','title','description'));
    }

    public function all_games(Request $request)
    {
        $title =   __('messages.all games title'); 
        $description =  "";
        return view('frontend.teams.all_games',compact('title','description'));
    }

    public function all_match(Request $request)
    {
        $title =   __('messages.all games'); 
        $description =   __('messages.all games');
        $page =  @$request->post('page') ?  $request->post('page') : 1;
        $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'all_match?lang='.Session::get('locale')."&currency=".Session::get('currency'), [
            'keywords'=> @$request->get('keywords'),
            'page' => $page,
            'limit' => 10000
        ]);
        $results = isset($response['results'])?$response['results']:"";
        return view('frontend.teams.all_match',compact('title','description','results'));
    }

   public function ticket_details_filter(Request $request)
    {
        $sourcetype =  @$request->post('sourcetype') ;
        $page = @$request->post('page') ? $request->post('page') : 1;
        
        try {
            $response =  Http::withHeaders([
                            'Accept' => 'application/json',
                            'domainkey' => DOMAIN_KEY
                        ])->post(API_URL .'sell_ticket_fliter?lang='.Session::get('locale')."&currency=".Session::get('currency')."&client_country=".@$_COOKIE["client_country"], [
                            'user_token' => @Session::get('user_token_id'),
                            'match_id'   => $request->post('match_id'),
                            'category'   => $request->post('category'),
                            'quantity'   => $request->post('quantity'),
                            'block_id'   => @$request->post('block_id'),
                            'limit'      => @$request->post('limit') ? $request->post('limit') : 10,
                            'seats_together'    => @$request->post('seats_together'),
                            'sub_category'      => @$request->post('sub_category') ? implode(",",$request->post('sub_category')) : "",
                            'price_with_fees'   => @$request->post('price_with_fees'),
                            'page'       => $page,
                            'sourcetype'   => $sourcetype,

                        ]);
            if($response->failed()){
                if($response->clientError()){
                    //catch all 400 exceptions
                    //Log::debug('client Error occurred in get request.');
                    $response->throw();
                }
                if($response->serverError()){
                    //catch all 500 exceptions
                    //Log::debug('server Error occurred in get request.');
                    $response->throw();
                }
                
            }


            $quantity = @$request->post('quantity');
            $category = @$request->post('category');
            $match_id = @$request->post('match_id');    
            $results  = $response['result'];
            $block_lists  = @$response['block_lists'];
            $filter_quantity = @$request->post('quantity');
            $returnHTML = view('frontend.ajax.ticket_selection_filter',compact('results','quantity','category','match_id','page','filter_quantity'))->render();
            
            return response()->json( array('success' => true, 'html'=>$returnHTML,'count' => count($results),'block_lists' => $block_lists ));
        }
    
        catch (\Exception $e) {
           echo $response;
        }

        catch (\Throwable $t) {
                    custom_error_log($t->getMessage());
        }

    }

    public function get_stadium_id(Request $request)
    {
        $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'get_stadium_id?lang='.Session::get('locale')."&currency=".Session::get('currency'), [
                        'stadium_id'=> $request->stadium_id,
                    ]);
        $result = $response['result'];
        $stadium_details = array('status' => 1);

        $stadium_details['Json']  = $result;

        return response($stadium_details,200);
    }
}
