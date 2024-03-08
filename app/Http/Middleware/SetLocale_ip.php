<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        if(@$_COOKIE["client_country"] == "") {
          
            //$_SERVER['HTTP_TRUE_CLIENT_IP']
            /* $resposne = file_get_contents("http://www.geoplugin.net/json.gp?ip=".$_SERVER['REMOTE_ADDR']);
                if(@$resposne){
                    $json_array = json_decode($resposne,true);
                    
                    if(@$json_array['geoplugin_countryCode']){
                      //  echo $json_array['geoplugin_countryCode'];die;
                        setcookie("client_country", $json_array['geoplugin_countryCode'], time() + (60 * 60 * 24 * 365), "/"); 
                    }
                }*/
               

                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.apilayer.com/ip_to_location/".$_SERVER['HTTP_TRUE_CLIENT_IP'],
                CURLOPT_HTTPHEADER => array(
                "Content-Type: text/plain",
                "apikey: nhsGPMaHHiBOQtFTdxdkJhpprKM7872w"
                ),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET"
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                $formatted_response = json_decode($response,1);
              // echo "<pre>";print_r($formatted_response);exit;
                if(@$formatted_response['country_code'] != ""){
                 //setcookie("client_country", $formatted_response['country_code'], time() + (60 * 60 * 24 * 365), "/"); 
                    setcookie("client_country", $formatted_response['country_code'], time() + (60 * 60 * 24 * 365), "/"); 
                }

           
        }
        
        if(@$_COOKIE["client_id"] == "") {
            $client_id = "-".rand(1000000,99999999);
            setcookie("client_id", $client_id, time() + (60 * 60 * 24 * 365), "/"); 
        }

        $language = session()->get('locale');
        if($language != $request->segment(1)){
                \Session::put('locale', $request->segment(1));
        }
        app()->setlocale($request->segment(1));
        return $next($request);
    }
}
