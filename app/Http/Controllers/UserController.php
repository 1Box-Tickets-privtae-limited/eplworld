<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Jenssegers\Agent\Agent;
use Storage;
use Hash;
use Session;
use Auth;
use DB;
use Socialite;
use Response;
use ZipArchive;


class UserController extends Controller
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

    public function login(Request $request)
    {   

        //pr($request->post());

        $this->validate($request, [
            'email'                  => 'required|email',
            'password'             => 'required',
        ]);
        $email = $request->email;
        $password = $request->password;

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'login?lang='.Session::get('locale'), [
                        'email'     => $email,
                        'password'  => $password,

        ]);
        $result = $response['result'];
        if($result['status'] == 1) {
            //pr($result);die;
            if(($request->post('remember') == 'on')){
                $days = 30;
                $value = base64_encode(json_encode(['username'=>$email,'password'=>$password]));
                setcookie ("rememberme",$value,time()+ ($days * 24 * 60 * 60 * 1000));
            }
            Session::put('user_token', $result['user_token']);
            Session::put('first_name', $result['first_name']);
            Session::put('last_name', $result['last_name']);
            Session::put('email', $result['email']);
            Session::put('mobile', $result['mobile']);
            Session::put('country_code', $result['country_code']);
            Session::put('country',$result['country']);
            Session::put('city',$result['city']);
            Session::put('user_id', $result['user_id']);
            Session::put('address', $result['address']);
            Session::put('postal_code', $result['postal_code']);
            $response = ["message" => "Login Success",'status' => 1];
            return response($response, 200);
        }
        else{
            $response = ["message" => $result['message'] ,'status' => 0];
            return response($response, 200);
        }
    }


    public function user_login(Request $request)
    {   
        
        $token = Session::get('user_token');
        if($token !=""){
            return redirect(app()->getLocale().'/profile');
        }
        return view('frontend.user.login');
    }

    public function register(Request $request)
    { 
        $token = Session::get('user_token');
        if($token !=""){
            return redirect(app()->getLocale().'/profile');
        }
        $country_response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->get(API_URL .'country?lang='.Session::get('locale'));
        $country = $country_response['results'];
        return view('frontend.user.register',compact('country'));
    }

    public function update_nominee(Request $request)
    {
        $token = Session::get('user_token');
        if($token ==""){
            return redirect('');
        }
        $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'update_nominee?lang='.Session::get('locale'), [
                        'first_name'  => $request->post('first_name'),
                        'last_name'  => $request->post('last_name'),
                        'nationality'  => $request->post('nationality'),
                        'dob'  => $request->post('dob'),
                        'booking_id'         => $request->post('booking_id'),
        ]);
              ///   echo "<pre>";print_r($response['result']);exit;
        if($response->successful() == 200){
              $update_nominee =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'cron/update-nominee-notfication', [
                        'bg_id'         => $request->post('booking_id')
        ]);

                  /*echo ($update_nominee);
                    echo "<pre>";print_r($update_nominee['results']);exit;*/
            Session::flash('success', $response['message']);
            return redirect(app()->getLocale().'/nominee/'.$response['booking_id']);
        }
        else{
            Session::flash('error', $response['message']);
            return redirect(app()->getLocale().'/nominee/'.$response['booking_id']);
        }
    }

    public function update_applynominee(Request $request)
    {
       
        $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'update_applynominee?lang='.Session::get('locale'), [
                        'first_name'  => $request->post('first_name'),
                        'last_name'  => $request->post('last_name'),
                        'email'  => $request->post('email'),
                       // 'nationality'  => $request->post('nationality'),
                      //  'dob'  => $request->post('dob'),
                        'booking_id'         => $request->post('booking_id'),
        ]);
              ///   echo "<pre>";print_r($response['result']);exit;
        if($response->successful() == 200){
              $update_nominee =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'update-nominee-notfication', [
                        'bg_id'         => $request->post('booking_id')
        ]);

                  /*echo ($update_nominee);
                    echo "<pre>";print_r($update_nominee['results']);exit;*/
            Session::flash('success', $response['message']);
            return redirect(app()->getLocale().'/applynominee/'.$response['booking_id']);
        }
        else{
            Session::flash('error', $response['message']);
            return redirect(app()->getLocale().'/applynominee/'.$response['booking_id']);
        }
    }



    public function applynominee($lang,$booking_no)
    { 
       
        $tickets =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'get_nominee_v1?lang='.Session::get('locale'), [
                        'booking_id'         => $booking_no
        ]);
        $ticket_count = $tickets['ticket_count'];
        $matches = $tickets['matches'];
        $booking = $tickets['booking_no'];
        $tickets = $tickets['result'];
        $booking_id = $booking_no;
        $title = "Nominee";
        $description = "Nominee";
        $agent = new Agent();
        $mobile  = $agent->isMobile();
        return view('frontend.user.applynominee',compact('tickets','matches','booking','booking_id','title','description','ticket_count','mobile'));
    }

    public function nominee($lang,$booking_no)
    { 
        $token = Session::get('user_token');
        if($token ==""){
            return redirect('');
        }
        $tickets =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'get_nominee?lang='.Session::get('locale'), [
                        'booking_id'         => $booking_no
        ]);//echo print_r($tickets['matches']);exit;
        $matches = $tickets['matches'];
        $booking = $tickets['booking_no'];
        $tickets = $tickets['result'];
        $booking_id = $booking_no;
        $title = "Nominee";
        $description = "Nominee";
        return view('frontend.user.nominee',compact('tickets','matches','booking','booking_id','title','description'));
    }
    
    public function dashboard(Request $request)
    {
        $token = Session::get('user_token');
        if($token ==""){
            return redirect('');
        }
        $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                    ])->get(API_URL .'get_profile?lang='.Session::get('locale'));
        $user = $response['result'];
        $address = $response['address'];
        //pr($address,1);
        $country_response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->get(API_URL .'country');
        $country = $country_response['results'];
        $states = array();
        if(@$address['country']){
            $states_response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'state',['country_id' =>$address['country'] ]);
            $states = $states_response['results'];
        }

        //http://localhost/1box/storefront/api/country
        $title = "Profile";
        $description = "Profile";
        $active = 1;
        return view('frontend.user.profile',compact('user','country','address','states','title','description','active'));
    }

     public function register_post(Request $request)
    {
        $token = Session::get('user_token');

        //pr($request->post());die;

        $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'register?lang='.Session::get('locale'), [
                        'first_name'            => $request->post('firstname'),
                        'last_name'             => $request->post('lastname'),
                        'dialing_code'          => $request->post('dialing_code'),
                        'mobile'                => $request->post('phone'),
                        'email'                 => $request->post('email'),
                        'password'              => $request->post('password'),
                        'confirm_password'      => $request->post('password_confirm'),
                        'newsletter'            => $request->post('newsletter'),
                        'terms'                 => $request->post('aggree'),
                        'address'                => $request->post('address'),
                        'postal_code'            => $request->post('postcode'),
                        'country'                => $request->post('country'),
                        'state'                  => $request->post('city'),
        ]);
         if($response->successful() == 200){
            $response = ["message" => $response['message'],'status' => 1];
            return response($response, 200);
        }
        else{
            $response = ["message" => $response['message'],'status' => 0];
            return response($response, 200);
        }


    }

     public function profile(Request $request)
    {
        $token = Session::get('user_token');
        if($token ==""){
            return redirect('');
        }
        $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                    ])->get(API_URL .'get_profile?lang='.Session::get('locale'));

        $user = $response['result'];
        //$address = $response['address'];
        //pr($user,1);
        $country_response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->get(API_URL .'country');
        $country = $country_response['results']; 
        $states = array();
        if(@$address['country']){
            $states_response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'state',['country_id' =>$address['country'] ]);
            $states = $states_response['results'];
        }

        //http://localhost/1box/storefront/api/country
        $title = "Profile";
        $description = "Profile";
        $active = 1;
        return view('frontend.user.profile',compact('user','country','states','title','description'));
    }

    public function profile_update(Request $request)
    {
        $token = Session::get('user_token');
        if($token ==""){
            return redirect('');
        }
        // $first_name = $request->post('first_name');
        // $last_name = $request->post('last_name');
        // $areacode = $request->post('areacode');
        // $mobile = $request->post('mobile');
        // $newsletter = $request->post('newsletter') ? $request->post('newsletter') : 0;

        // $address_title = $request->post('address_title');
        // $address_name = $request->post('address_name');
        // $address_surname = $request->post('address_surname');
        // $address_address = $request->post('address_address');
        // $address_postal_code = $request->post('address_postal_code');
        // $address_country = $request->post('address_country');
        // $address_state = $request->post('address_state');
        // $address_title = $request->post('address_title');
        // $address_dialing_code = $request->post('address_dialing_code');
        // $address_phone = $request->post('address_phone');
        $data = [
                        'first_name'            => $request->post('first_name'),
                        'last_name'             => $request->post('last_name'),
                        'dialing_code'          => $request->post('dialing_code'),
                        'mobile'                => $request->post('mobile'),
                        'country'               => $request->post('country'),
                        'state'                 => $request->post('state'),
                        'address'               => $request->post('address'),
                        'code'                  => $request->post('postcode'),


                        'newsletter'            => $request->post('newsletter') ? $request->post('newsletter') : 0,
                        'address_title'         => $request->post('address_title'),
                        'address_name'          => $request->post('address_name'),
                        'address_surname'       => $request->post('address_surname'),
                        'address_address'       => $request->post('address_address'),
                        'address_postal_code'   => $request->post('address_postal_code'),
                        'address_country'       => $request->post('address_country'),
                        'address_state'         => $request->post('address_state'),
                        'address_title'         => $request->post('address_title'),
                        'address_dialing_code'  => $request->post('address_dialing_code'),
                        'address_phone'         => $request->post('address_phone'),
        ];
    
        $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'update_profile?lang='.Session::get('locale'), $data);
                     //pr( $response['message']);die;
        if($response->successful() == 200){
            //pr( $response['message']);die;
            Session::flash('success', $response['message']);
            return redirect(app()->getLocale().'/profile');
        }
        else{
            Session::flash('error', $response['message']);
            return redirect(app()->getLocale().'/profile');
        }
      
    }

     public function download($lang,$booking_no)
    {
        $token = Session::get('user_token');
        if($token ==""){
            return redirect('');
        }
         $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'get_orders?lang='.Session::get('locale'), [
                        'booking_no'         => $booking_no
        ]);
         if($booking_no != ''){ 
            $results = $response['result'][0];
             $tickets_download =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'cron/send-download-notification', [
                        'bg_id'         => $results['bg_id']
        ]);
                   // echo "<pre>";print_r($tickets_download['results']);exit;
              $tickets =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'download_tickets?lang='.Session::get('locale'), [
                        'booking_id'         => $results['bg_id']
        ]);
                }
           $files_download = array();
            foreach ($tickets['result'] as $tickets_download) {

             $fileSource = $tickets_download['src'];
             $fileName = $tickets_download['filename'];
             $headers = ['Content-Type: application/pdf'];
            file_put_contents(storage_path().'/tickets/'.$fileName, file_get_contents($fileSource) ); 
            chmod(storage_path().'/tickets/'.$fileName, fileperms(storage_path().'/tickets/'.$fileName) | 128 + 16 + 2);
            $files_download[] = storage_path().'/tickets/'.$fileName;
            }
            $public_dir=public_path();
            $zipFileName = $results['booking_no'].'_Tickets.zip';
            // Create ZipArchive Obj
            $zip = new ZipArchive;
            if ($zip->open($public_dir . '/' . $zipFileName, ZipArchive::CREATE) === TRUE) {
                // Add File in ZipArchive
                foreach($tickets['result'] as $file) {
                 //   echo storage_path().'/tickets/'.$file['filename'];exit;
                $zip->addFile(storage_path().'/tickets/'.$file['filename'], $file['filename']);
                }      
                // Close ZipArchive     
                $zip->close();
            }
            // Set Header
            $headers = array(
                'Content-Type' => 'application/octet-stream',
            );
            $filetopath=$public_dir.'/'.$zipFileName;
            // Create Download Response
            if(file_exists($filetopath)){
                    $tickets_download =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'cron/send-download-notification', [
                        'bg_id'         => $results['bg_id']
        ]);
                return response()->download($filetopath,$zipFileName,$headers);
            }

    }


    public function account_update(Request $request)
    {
        $token = Session::get('user_token');
        if($token ==""){
            return redirect('');
        }
        $account_holder = $request->post('account_holder');
        $account_number = $request->post('account_number');
        $bic = $request->post('bic');

        $response = Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'update_account?lang='.Session::get('locale'), [
                    'account_holder'    => $request->account_holder,
                    'account_number'    => $request->account_number,
                    'bic'               => $request->bic,
                ]);
        //pr( $response['message']);die;
        //  pr($response->getStatusCode()); ;die;
        if($response->successful() == 200){
            //pr( $response['message']);die;
            Session::flash('account_success', $response['message']);
            return redirect(app()->getLocale().'/profile');
        }
        else{
            Session::flash('account_error', $response['message']);
            return redirect(app()->getLocale().'/profile');
        }
      
    }

    public function orders($lang,$booking_no='')
    { 
        $token = Session::get('user_token');
        if($token ==""){
            return redirect('');
        }
        //$results = array();
    /*    $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                    ])->get(API_URL .'get_orders?lang='.Session::get('locale'));*/

         $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'get_orders?lang='.Session::get('locale'), [
                        'booking_no'         => $booking_no
        ]);
        $agent = new Agent();
        $mobile  = $agent->isMobile();
                   // echo $booking_no;exit;
        //pr($response['result']);
        if($booking_no != ''){ 
            $results = isset($response['result'][0])?$response['result'][0]:"";

              $tickets =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'get_etickets?lang='.Session::get('locale'), [
                        'booking_id'         => $results['bg_id']
        ]);

            $etickets = isset($tickets['result'])?$tickets['result']:"";
            $active_tickets = $tickets['active_tickets'];  
            $empty_nominee = $tickets['empty_nominee'];                
            $title = "Orders";
            $description = "Orders";
             $active = 2;
            return view('frontend.user.orders_details',compact('results','etickets','active_tickets','empty_nominee','title','description','mobile','active'));
        }
        else{
            $results = isset($response['result'])?$response['result']:"";
            $title = "My Orders";
            $description = "My Orders";
            $active = 2;
            return view('frontend.user.orders',compact('results','title','description','mobile','active'));
        }
        
    }

    public function address(Request $request)
    {
        $token = Session::get('user_token');
        if($token ==""){
            return redirect('');
        }
        $results = array();
        $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                    ])->get(API_URL .'get_address?lang='.Session::get('locale'));
        
         $results = $response['results'];
        

        $country_response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->get(API_URL .'country');
        $country = $country_response['results'];
        $title = "Address";
        $description = "Address";
        $active = 3;
        return view('frontend.user.address',compact('results','country','title','description','active'));

    }

    public function add_address(Request $request)
    {
        $token = Session::get('user_token');
        if($token ==""){
            return redirect('');
        }
        $add_address_post = [
                        'title'         => $request->post('address_title'),
                        'name'          => $request->post('address_name'),
                        'title'         => $request->post('address_title'),
                        'email'         => $request->post('email'),
                        'surname'       => $request->post('address_surname'),
                        'address'       => $request->post('address_address'),
                        'postal_code'   => $request->post('address_postal_code'),
                        'country'       => $request->post('country'),
                        'state'         => $request->post('state'),
                        'dialing_code'  => $request->post('dialing_code'),
                        'phone'         => $request->post('address_phone'),
                        'delivery_title'  => $request->post('delivery_title'),
                        'delivery_first_name'  => $request->post('delivery_first_name'),
                        'delivery_last_name'  => $request->post('delivery_last_name'),
                        'delivery_email'  => $request->post('delivery_email'),
                        'delivery_dailing_code'  => $request->post('delivery_dailing_code'),
                        'delivery_mobile'  => $request->post('delivery_mobile'),
                        'delivery_address'  => $request->post('delivery_address'),
                      
                        'delivery_state'  => $request->post('delivery_state'),
                        'delivery_country'  => $request->post('delivery_country'),
                        'delivery_postal_code'  => $request->post('delivery_postal_code'),
        ];
        //r($add_address_post);die;
        $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'add_address?lang='.Session::get('locale'), $add_address_post);

        if($response->successful() == 200){
            Session::flash('success', $response['message']);
            return redirect(app()->getLocale().'/address');
        }
        else{
            Session::flash('error', $response['message']);
            return redirect(app()->getLocale().'/address');
        }
    }

     public function change_password(Request $request)
    {
        $token = Session::get('user_token');
        if($token ==""){
            return redirect('');
        }
        //$results = array();
        // $response =  Http::withHeaders([
        //                 'Accept' => 'application/json',
        //                 'Authorization' => 'Bearer '.$token,
        //             ])->get(API_URL .'get_purchase');
        // $results = $response['address'];
        //pr($results);
        $title = "Change Password";
        $description = "Change Password";
         $active = 4;
        return view('frontend.user.change_password',compact('title','description','active'));

    }

    public function auth_google(Request $request)
    {
        $type = @$_GET['type'] == 1 ?  "checkout" : "dashboard";
        Session::put('login_redirect', $type);
        return Socialite::driver('google')->redirect();
    }

    public function callback_google(Request $request)
    {

        $token = Session::get('user_token');
        $user = Socialite::driver('google')->stateless()->user();
            $first_name = "";
            $last_name = "";
            if($user->name){
                $name = explode(",", $user->name);
                $first_name = $name[0];
                $last_name = end($name);
            }
            $email = "";
            if($user->email)  $email = $user->email;    
            $password  = md5($user->name.'@'.$user->id);

            
            $data =  array(
                        'first_name'            => $first_name,
                        'last_name'             => $last_name,
                        'login_type'            => "google",
                        'login_id'              => $user->id,
                        'email'                 => $email,
                        'password'              => $password,
                        'confirm_password'      => $password,
            );

            
           $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'social_login?lang='.Session::get('locale'), $data);
            $result = $response['result'];
            if($result['status'] == 1) {
                Session::put('user_token', $result['user_token']);
                Session::put('first_name', $result['first_name']);
                Session::put('email', $result['email']);
                Session::put('user_id', $result['user_id']);
                //$response = ["message" => "Login Success",'status' => 1];
                // return redirect()->back()->with('success', 'Login Success');
                 $login_redirect = Session::get('login_redirect');
                 return redirect(app()->getLocale()."/".$login_redirect);   
            }
            else{
                //$response = ["message" => $result['message'] ,'status' => 0];
                 return redirect(app()->getLocale().'/register');
            }
    }

    public function auth_facebook(Request $request)
    {
        $type = @$_GET['type'] == 1 ?  "checkout" : "dashboard";
        Session::put('login_redirect', $type);
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFromFacebook()
     {
      try {
            $token = Session::get('user_token');
            $user = Socialite::driver('facebook')->stateless()->user();
            $first_name = "";
            $last_name = "";
            if($user->getName()){
                $name = explode(",", $user->getName());
                $first_name = $name[0];
                $last_name = end($name);
            }
            $email = "";
            if($user->getEmail())  $email = $user->getEmail();    
            $password  = md5($user->getName().'@'.$user->getId());


            $data =  array(
                        'first_name'            => $first_name,
                        'last_name'             => $last_name,
                        'login_type'            => "facebook",
                        'login_id'              => $user->getId(),
                        'email'                 => $email,
                        'password'              => $password,
                        'confirm_password'      => $password,
            );


           $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'social_login?lang='.Session::get('locale'), $data);
            $result = $response['result'];
            if($result['status'] == 1) {
                Session::put('user_token', $result['user_token']);
                Session::put('first_name', $result['first_name']);
                Session::put('email', $result['email']);
                Session::put('user_id', $result['user_id']);
                //$response = ["message" => "Login Success",'status' => 1];
                // return redirect()->back()->with('success', 'Login Success');
                $login_redirect = Session::get('login_redirect');
                return redirect(app()->getLocale()."/".$login_redirect); 
            }
            else{
                //$response = ["message" => $result['message'] ,'status' => 0];
                 return redirect(app()->getLocale().'/register');
            }
           } catch (\Throwable $th) {
              throw $th;
        }
    }

    public function logout()
    {
        //Session::flush();

        Session::forget('user_token');
        Session::forget('first_name');
        Session::forget('last_name');
        Session::forget('email');
        Session::forget('user_id');
        Session::forget('mobile');
        Session::forget('country');
        Session::forget('country_code');
        return redirect('');
    }

    public function change_password_post(Request $request)
    {
        $token = Session::get('user_token');
        if($token ==""){
            return redirect('');
        }
        $results = array();
        $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'change_password?lang='.Session::get('locale'), [
                        'old_password'        => $request->post('old_password'),
                        'new_password'        => $request->post('new_password'),
                        'confirm_password'    => $request->post('confirm_password'),
        ]);
        if($response->successful() == 200){
            Session::flash('success', $response['message']);
            return redirect(app()->getLocale().'/change-password');
        }
        else{
            Session::flash('error', $response['message']);
            return redirect(app()->getLocale().'/change-password');
        }

    }


    public function delete_address(Request $request)
    { 
        $token = Session::get('user_token');
        if($token ==""){
            return redirect('');
        }
        $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'delete_address?lang='.Session::get('locale'),[
                        'address_id' => $request->id
                    ]);
        if($response->successful() == 200){
            Session::flash('success', $response['message']);
            return redirect(app()->getLocale().'/address');
        }
        else{
            Session::flash('error', $response['message']);
            return redirect(app()->getLocale().'/address');
        }
    }
  
    public function edit_address(Request $request)
    {
        $token = Session::get('user_token');
        if($token ==""){
            return redirect('');
        }
        $results = array();
        $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'get_address_id?lang='.Session::get('locale'),[
                        'address_id' => base64_decode($request->id)
                    ]);
        
        $results = $response['result'];
        //pr($results);die;
        $country_response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->get(API_URL .'country');
        $country = $country_response['results'];
        $state_response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'state',['country_id'=>$results['country']]);
        $states = $state_response['results'];
          $title = "Edit Address";
        return view('frontend.user.edit_address',compact('results','country','states','title'));
    }

    public function update_address(Request $request)
    {
        $token = Session::get('user_token');
        if($token ==""){
            return redirect('');
        }
        $address_post = [
                        'address_id'    => base64_decode($request->post('address_id')),
                        'title'         => $request->post('address_title'),
                        'name'          => $request->post('address_name'),
                        'surname'       => $request->post('address_surname'),
                        'address'       => $request->post('address_address'),
                        'postal_code'   => $request->post('address_postal_code'),
                        'country'       => $request->post('country'),
                        'state'         => $request->post('state'),
                        'dialing_code'  => $request->post('dialing_code'),
                        'phone'         => $request->post('address_phone'),
                        'email'         => $request->post('email'),

                        'delivery_title'  => $request->post('delivery_title'),
                        'delivery_first_name'  => $request->post('delivery_first_name'),
                        'delivery_last_name'  => $request->post('delivery_last_name'),
                        'delivery_email'  => $request->post('delivery_email'),
                        'delivery_dailing_code'  => $request->post('delivery_dailing_code'),
                        'delivery_mobile'  => $request->post('delivery_mobile'),
                        'delivery_address'  => $request->post('delivery_address'),
                      
                        'delivery_state'  => $request->post('delivery_state'),
                        'delivery_country'  => $request->post('delivery_country'),
                        'delivery_postal_code'  => $request->post('delivery_postal_code'),
                        



        ];

        $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'edit_address?lang='.Session::get('locale'), $address_post);
        //echo $response;die;
        if($response->successful() == 200){
            Session::flash('success', $response['message']);
            return redirect(app()->getLocale().'/address');
        }
        else{
            Session::flash('error', $response['message']);
            return redirect(app()->getLocale().'/address');
        }
    }

    public function forgot_password(Request $request)
    {  
        $response =  Http::withHeaders([
            'Accept' => 'application/json',
            'domainkey' => DOMAIN_KEY
        ])->post(API_URL .'forget_password?lang='.Session::get('locale'),[
                        'email' => $request->post('email')
                    ]);
        if($response->successful() == 200){
            $response = ["message" => $response['result']['message'],'status' => 1];
            return response($response, 200);
        }
        else{
            $response = ["message" => $response['result']['message'],'status' => 0];
            return response($response, 200);
        }
        
    }

    public function reset_password(Request $request)
    {
        $token = $request->token;
        if(!$token){
            return redirect('');
        }
        $title = "Reset Password";
        return view('frontend.user.reset_password',compact('token','title'));
    }

    public function reset_password_post(Request $request)
    {
        $response =  Http::withHeaders([
                    'Accept' => 'application/json',
                    'domainkey' => DOMAIN_KEY
                ])->post(API_URL .'reset_password?lang='.Session::get('locale'),[
                    'verification_code' => $request->post('token'),
                    'new_password'      => $request->post('new_password'),
                    'confirm_password'  => $request->post('confirm_password')
                ]);
               
        $result = $response['result'];
        if($result['status'] == 1){
            Session::flash('rest_success', $result['message']);
            $response = ["message" => $response['result']['message'],'status' => 1];
            return response($response, 200);
        }
        else{
            Session::flash('error', $result['message']);
            $response = ["message" => $response['result']['message'],'status' => 0];
            return response($response, 200);
        }
    }

    public function email_verification(Request $request)
    { 
        $response =  Http::withHeaders([
                    'Accept' => 'application/json',
                    'domainkey' => DOMAIN_KEY
                ])->post(API_URL .'activation?lang='.Session::get('locale'),[
                    'verification_key' => $request->token,
                ]);
       
        $result = $response['result'];
        if($result['status'] == 1){
            Session::flash('activation-message', $result['message']);
        }
        else{
            Session::flash('activation-message', $result['message']);
        }
        return redirect(app()->getLocale().'/');
    }

    public function orders_test($lang,$booking_no='')
    { 
        $token = Session::get('user_token');
        if($token ==""){
            return redirect('');
        }
        //$results = array();
    /*    $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                    ])->get(API_URL .'get_orders?lang='.Session::get('locale'));*/

         $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'get_orders?lang='.Session::get('locale'), [
                        'booking_no'         => $booking_no
        ]);
        $agent = new Agent();
        $mobile  = $agent->isMobile();
                   // echo $booking_no;exit;
        //pr($response['result']);
        if($booking_no != ''){ 
            $results = isset($response['result'][0])?$response['result'][0]:"";

              $tickets =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                    ])->post(API_URL .'get_etickets?lang='.Session::get('locale'), [
                        'booking_id'         => $results['bg_id']
        ]);

            $etickets = isset($tickets['result'])?$tickets['result']:"";
            $active_tickets = $tickets['active_tickets'];  
            $empty_nominee = $tickets['empty_nominee'];                
            $title = "Orders";
            $description = "Orders";

            return view('frontend.user.orders_details',compact('results','etickets','active_tickets','empty_nominee','title','description','mobile'));
        }
        else{
            $results = isset($response['result'])?$response['result']:"";
            $title = "My Orders";
            $description = "My Orders";
            return view('frontend.user.orders_test',compact('results','title','description','mobile'));
        }
        
    }

    public function get_chats(Request $request){
       $token = Session::get('user_token');
        if($token ==""){
            return redirect('');
        }
        $booking_id = $request->booking_id; 
        $status = $request->status;
       

        $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                        ])
                        ->post(API_URL .'get-chats?lang='.Session::get('locale'), [
                            'booking_id' => $booking_id,
                            'status'     => $status
                        
                        ]);
       // echo $response;die;
        $result = $response['result'];
        if($response['status'] == 1){
           
            $response = ["message" => $response['result'],'status' => 1];
            echo  json_encode($response, 200);
        }
        else{
           
            $response = ["message" => $response['result'],'status' => 0];
            echo  json_encode($response, 200);
        }
    }

    public function save_chat(Request $request){

       $token = Session::get('user_token');
        if($token ==""){
            return redirect('');
        }
        $booking_id = $request->input('id');
        $message = $request->input('message');
        $response =  Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                        'domainkey' => DOMAIN_KEY
                        ])
                        ->post(API_URL .'save-chat?lang='.Session::get('locale'), [
                            'booking_id' => $booking_id,
                            'message' => $message,
                        
                        ]);
        echo $response;die;
        $result = $response['result'];
    }
}