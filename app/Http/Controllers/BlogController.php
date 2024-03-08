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


class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function index() 
    {
        $title =   __('messages.blog');
        $description =   __('messages.blog');

        $currency = Session::get('currency');
        $results =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->get(API_URL .'blog?lang='.Session::get('locale')."&currency=".$currency);

        $blogs          = isset($results['blogs'])?$results['blogs']:"";
        $news          = isset($results['news'])?$results['news']:"";


        $page =  1;
        $upcoming_matches =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'all_match?lang='.Session::get('locale')."&currency=".Session::get('currency'), [
            'keywords'=> "",
            'page' => $page,
            'top_games' => 1,
            'limit' => 4
        ]);
        
        $upcoming = isset($upcoming_matches['results'])?$upcoming_matches['results']:"";

        return view('frontend.blog.index',compact('title','description','blogs','news','upcoming'));
    }

    public function all_blogs_ajax(Request $request) 
    {
        $title =  "Blog";
        $description =  "";
        $limit = $request->limit ? $request->limit : 9;
        $page = $request->page ? $request->page : 1;
        $upcoming_matches =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'blog-list?lang='.Session::get('locale')."&currency=".Session::get('currency'), [
            'page' => $page,
            'limit' => $limit
        ]);
        
        $blogs = isset($upcoming_matches['blogs'])?$upcoming_matches['blogs']:"";
        $returnHTML =  view('frontend.blog.all_blogs_ajax',compact('title','description','blogs'))->render();


         return response()->json( array('success' => true, 'html'=>$returnHTML) );
    }


    public function all_other() 
    {
        $title =  __('messages.all latest blog');
        $description = __('messages.all latest blog');

        $page =  1;
        $upcoming_matches =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'all_match?lang='.Session::get('locale')."&currency=".Session::get('currency'), [
            'keywords'=> "",
            'page' => $page,
            'top_games' => 1,
            'limit' => 4
        ]);
        
        $upcoming = isset($upcoming_matches['results'])?$upcoming_matches['results']:"";

        return view('frontend.blog.all_other',compact('title','description','upcoming'));
    }



    public function details(Request $request,$lang,$slug) 
    {
       
       
        $currency = Session::get('currency');
        $results =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'blog_details?lang='.Session::get('locale')."&currency=".$currency,['slug' =>$slug ]);
        
        $result = isset($results['results'])? $results['results']:"";
         if(@$request->q == 1){
                  echo ($results); die;
        }
        if(@$results['status'] ==  0 ){
            $title =  "Page Not Found";
            $description = "";
            return response()->view('errors.' . '404', [$title,$description], 404);
        }
        $results =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->get(API_URL .'blog?lang='.Session::get('locale')."&currency=".$currency."&limit=8");

        $blogs          = isset($results['blogs'])?$results['blogs']:"";

        $title =  @$result['meta_title'] ? $result['meta_title']  : $result['blog_title'];
        $description =  @$result['meta_description'] ? $result['meta_description']  : $result['blog_short_description'];
        return view('frontend.blog.details',compact('title','description','result','blogs'));
    }

    public function latest_blog() 
    {
        $title =  "Latest Blog";
        $description =  "";
        return view('frontend.blog.latest_blog',compact('title','description'));
    }

    public function all() 
    {
        $title =  "Latest Blog";
        $description =  "";
        return view('frontend.blog.all',compact('title','description'));
    }

}