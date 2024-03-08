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


class AjaxController extends Controller
{
    function index(Request $request)
    {   
       try{
            $currency       = Session::get('currency');
           $response       = Http::withHeaders([
                                        'Accept' => 'application/json',
                                        'domainkey' => DOMAIN_KEY
                                        ])->get(API_URL .'home_ajax?lang='.Session::get('locale')."&currency=".$currency."&client_country=".@$_COOKIE["client_country"]);

           $oe_response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->get(API_URL .'other_events?lang='.Session::get('locale')."&currency=".Session::get('currency'));

            if($response->successful()){
                $tournaments    = @$response['tournaments'];
                $top_teams      = @$response['top_teams'];
                $top_matchs     = @$response['top_matchs'];
                $upcoming       = @$response['upcoming'];
                $top_matchs_oe     = @$oe_response['results'];
                
                $layout = "frontend.ajax.index";
                $returnHTML = view($layout,compact('tournaments','top_teams','top_matchs','upcoming','top_matchs_oe'))->render();
                return response()->json( array('success' => true, 'html'=>$returnHTML) );
            }
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
        }            
         catch(ConnectException $e)
        {
            //log error
        }

        
    }

    function tournaments(Request $request)
    {
        $currency = Session::get('currency');
        $response =  Http::withHeaders([
                                'Accept' => 'application/json',
                                'domainkey' => DOMAIN_KEY
                            ])->get(API_URL .'get_tournament?lang='.Session::get('locale')."&currency=".Session::get('currency')."&client_country=".@$_COOKIE["client_country"]);

        $results = isset($response['results'])?$response['results']:"";
        $returnHTML = view('frontend.ajax.tournaments',compact('results'))->render();
        return response()->json( array('success' => true, 'html'=>$returnHTML) );
    }

    function top_teams(Request $request)
    {
        $currency = Session::get('currency');
        $response =  Http::withHeaders([
                                'Accept' => 'application/json',
                                'domainkey' => DOMAIN_KEY
                            ])->get(API_URL .'top_teams?lang='.Session::get('locale')."&currency=".$currency);
        $results = isset($response['results'])?$response['results']:"";
        $returnHTML = view('frontend.ajax.top_teams',compact('results'))->render();
        return response()->json( array('success' => true, 'html'=>$returnHTML) );
    }

    public function other_events(Request $request)
    {
        $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->get(API_URL .'other_events?lang='.Session::get('locale')."&currency=".Session::get('currency'));

        $results        = isset($response['results'])?$response['results']:"";
        $returnHTML     = view('frontend.ajax.other_events',compact('results'))->render();
        return response()->json( array('success' => true, 'html'=>$returnHTML) );
    }

    public function all_teams(Request $request)
    {
        $currency = Session::get('currency');
        $filter = [];
        if($request->search_keyword){
            $filter['keywords'] = $request->search_keyword;
        }
        if($request->sort_by){
            $filter['sort_by'] =  $request->sort_by;
        }
        if($request->country){
            $filter['country'] =  $request->country;
        }
        
        $filter['lang'] = Session::get('locale');
        $filter['currency'] = Session::get('currency');

        $filter['limit'] = $request->limit ? $request->limit : 9;
        $filter['page'] = $page = $request->page ? $request->page : 1;

        $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->get(API_URL .'get_teams?',http_build_query($filter));
        
        // if(!empty($request->search_keyword) || !empty($request->sort_by) || !empty($request->country)){
        //     $response =  Http::withHeaders([
        //     'Accept' => 'application/json',
        //     'domainkey' => DOMAIN_KEY
        // ])->get(API_URL .'get_teams?',http_build_query($filter));
        // }else{
        //     $response =  Http::withHeaders([
        //     'Accept' => 'application/json',
        //     'domainkey' => DOMAIN_KEY
        //     ])->get(API_URL .'get_teams?lang='.Session::get('locale')."&currency=".$currency);
        // }
        $results        = isset($response['results'])?$response['results']:"";
        $returnHTML     = view('frontend.ajax.all_teams',compact('results','page'))->render();
        return response()->json( array('success' => true, 'html'=>$returnHTML) );
    }
   function hottickets(Request $request)
    {   
       try{ 
            $currency       = Session::get('currency');
            $response       = Http::withHeaders([
                                        'Accept' => 'application/json',
                                        'domainkey' => DOMAIN_KEY
                                        ])->get(API_URL .'hot_tickets?lang='.Session::get('locale')."&currency=".$currency."&client_country=".@$_COOKIE["client_country"]);
            //echo $response;die;
            if($response->successful()){
               
                $top_matchs     = @$response['top_matchs'];
                $tournaments     = @$response['tournaments'];
                $teams     = @$response['teams'];

                return response()->json( array('success' => true,'top_matchs' => $top_matchs,'tournament_list' => $tournaments,'team_list' => $teams) );
            }
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
        }            
         catch(ConnectException $e)
        {
            //log error
        }

        
    }


    public function all_games(Request $request)
    {
        $page =  @$request->post('page') ?  $request->post('page') : 1;
        $tournament =  @$request->post('tournament') ?  $request->post('tournament') : "";
        $selected_tournment="";
        if(!empty($request->get('tournament'))){
            $selected_tournment = $request->get('tournament');
        }
        $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'all_match?lang='.Session::get('locale')."&currency=".Session::get('currency'), [
            'keywords'=> @$request->get('keywords'),
            'page' => $page,
            'tournament' => $tournament,
            'limit' => @$request->post('limit') ?  $request->post('limit') : 12
        ]);
        
        $results = isset($response['results'])?$response['results']:"";
        $tournaments = isset($response['tournaments'])?$response['tournaments']:"";
        
        $returnHTML     = view('frontend.ajax.all_games',compact('results','page'))->render();
        return response()->json( array('success' => true, 'html'=>$returnHTML,'tournaments' => $tournaments,'selected_tournment' => $selected_tournment) );
    }
}