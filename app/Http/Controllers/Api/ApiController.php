<?php

namespace App\Http\Controllers\Api;
 
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Setting;
use App\Models\SiteSetting;
use App\Models\Countries;
use App\Models\States;
use App\Models\Register;
use App\Models\RegisterUserAddress;
use App\Models\MatchInfo;
use App\Models\Teams;
use App\Models\Stadium;
use App\Models\Tournament;

 
class ApiController extends Controller
{
    
    public function __construct()
    {

    }

    public function setting(Request $request){
        $data['general_setting']  = Setting::get();
        $data['site_setting']  = SiteSetting::get();
        return response(array("results" => $data),200);
    }

    public function get_games(Request $request){
        $current_date =  date('Y-m-d');
        $results  = MatchInfo::select('*')
                            ->where('status',1)
                            ->where('availability',1)
                            ->whereDate('match_date','>=', Carbon::today())
                            ->orderBy('match_date','ASC')
                            ->get();
        return response(array("results" => $results),200);
    }

    public function get_teams(Request $request){
        $current_date =  date('Y-m-d');
        $teams  = Teams::select('*')
                            ->where('status',1)
                            ->orderBy('team_name','ASC')
                            ->get();
        return response(array("results" => $teams),200);
    }

    public function get_stadium(Request $request){
        $current_date =  date('Y-m-d');
        $teams  = Stadium::select('*')
                            ->where('status',1)
                            ->orderBy('stadium_name','ASC')
                            ->get();
        return response(array("results" => $teams),200);
    }

    public function get_tournament(Request $request){
        $current_date =  date('Y-m-d');
        $teams  = Tournament::select('*')
                            ->where('status',1)
                            ->get();
        return response(array("results" => $teams),200);
    }


    public function login(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:255',
            'password' => 'required|string',
        ]);
        if ($validator->fails())
        {
            return response(['message'=>$validator->errors()->all()], 422);
        }
        $user = Register::select("api_token","id","first_name","last_name","email","mobile","password","status")
                 ->where('email', $request->email)
                 ->orWhere('mobile', $request->email)
                 ->first();
        if ($user) {
            //echo Hash::make($request->password);die;
            if (md5($request->password) == $user->password) {
               $api_token = $user->api_token;
               if($user->api_token  == ""){
                    $token = Str::random(50).time();
                    $api_token =  hash('sha256', $token);
                    Register::find($user->id)->update(['api_token' => $api_token]);
                }
                if($user->status == 1){
                    $response = [
                            'token'          => $api_token,
                            'user_id'        => $user->id,
                            'first_name'     => $user->first_name,
                            'first_name'     => $user->last_name,
                            'email'          => $user->email,
                            'mobile'         => $user->mobile,
                    ];
                     return response($response, 200);
                }
                else if($user->status == 0){
                    $response = ["message" => "your account is not activated."];
                    return response($response, 422);
                }
                else{
                    $response = ["message" => "your account is de-activated."];
                    return response($response, 422);
                }
               
            } 
            else 
            {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }
    }

    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'email'         => 'required|email|string|max:255',
            'password'      => 'required|string',
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'dialing_code'  => 'required|string',
            'mobile'        => 'required|int',
            'address'       => 'required|string',
            'country'       => 'required|int',
            'city'          => 'required|int',
            'terms'          => 'required|int',
        ]);

        if ($validator->fails())
        {
            return response(['message'=>$validator->errors()->all()], 422);
        }

        $register = Register::where('email',$request->email)->first();
        if($register){
            return response(['message'=> "Email id already exits."], 422);
        }

        
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $dialing_code = $request->dialing_code;
        $mobile = $request->mobile;
        $email = $request->email;
        $password  = md5($request->password);
        $address = $request->address;
        $country = $request->country;
        $state = @$request->state ? $request->state : "";
        $city = $request->city;
        $newsletter = @$request->newsletter;
        $terms = @$request->terms;
        $verification_key = Str::random(30);
        $token = Str::random(50).time();
        $api_token =  hash('sha256', $token);
        $code =  Str::random(6);

        $data = array(
                        'first_name'            => $first_name,
                        'last_name'             => $last_name,
                        'dialing_code'          => $dialing_code,
                        'mobile'                => $mobile,
                        'email'                 => strtolower($email),
                        'password'              => $password,
                        'confirm_password'      => $password,
                        'address'               => $address,
                        'country'               => $country,
                        'state'                 => $state,
                        'city'                  => $city,
                        'user_type'             => 'buyer',
                        'login_type'            => '',
                        'email_key'             => '',
                        'google_facebook_id'    => '',
                        'account_holder'        => '',
                        'account_number'        => '',
                        'bic'                   => '',
                        'newsletter'            => $newsletter,
                        'status'                => 0,
                        'active'                => 0,
                        'verification_key'      => $verification_key,
                        'code'                  => $code,
                        'terms'                 => $terms,
                        'api_token'             => $api_token,
                        'created_date'          => Carbon::now()->format("Y-m-d H:i:s")

        );
        $register = new Register; 
        $results = $register->create($data);
        $user_id = $results->id ;
        return response(array("user_id" => $user_id,'message' => "Register Successfully."),200);
    }

    public function get_profile(Request $request){
        $token = $request->bearerToken();
        $register = Register::select('first_name','last_name','email','dialing_code','mobile','newsletter','account_holder','account_number','bic')
                    ->where('api_token',$token)
                    ->first();
        if($register){
            return response(array("result" => $register),200);
        }
        else{
            return response(['message'=> "Unauthorized"], 422);
        }

    }  

    public function update_profile(Request $request){
        $id = $this->login_check($request);
        if($id == false)  return response(['message'=> "Unauthorized"], 422);
        $validator = Validator::make($request->all(), [
            'email'         => 'required|email|string|max:255',
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'dialing_code'  => 'required|string',
            'mobile'        => 'required|int',
        ]);

        if ($validator->fails())
        {
            return response(['message'=>$validator->errors()->all()], 422);
        }

        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $dialing_code = $request->dialing_code;
        $mobile = $request->mobile;
        $email = $request->email;
        $newsletter = @$request->newsletter ? @$request->newsletter : 1;

        $data = array(
                        'first_name'            => $first_name,
                        'last_name'             => $last_name,
                        'dialing_code'          => $dialing_code,
                        'mobile'                => $mobile,
                        'email'                 => strtolower($email),
                        'newsletter'            => $newsletter,
        );
        Register::find($id)->update($data);
        return response(array('message' => "Updated Successfully."),200);

    }


    public function update_account(Request $request){
        $id = $this->login_check($request);
        if($id == false)  return response(['message'=> "Unauthorized"], 422);
        $validator = Validator::make($request->all(), [
            'account_holder'         => 'required|string',
            'account_number'         => 'required|string',
            'bic'                    => 'required|string',
        ]);

        if ($validator->fails())
        {
            return response(['message'=>$validator->errors()->all()], 422);
        }

        $account_holder = $request->account_holder;
        $account_number = $request->account_number;
        $bic = $request->bic;

        $data = array(
                        'account_holder'            => $account_holder,
                        'account_number'            => $account_number,
                        'bic'                       => $bic,
        );
        Register::find($id)->update($data);
        return response(array('message' => "Updated Successfully."),200);
    }


    function change_password(Request $request) {
        $id = $this->login_check($request);
        if($id == false)  return response(['message'=> "Unauthorized"], 422);
        $validator = Validator::make($request->all(), [
            'new_password'           => 'required|string',
            'confirm_password'       => 'required|string',
            'old_password'           => 'required|string',
        ]);

        if ($validator->fails())
        {
            return response(['message'=>$validator->errors()->all()], 422);
        }

        if($id){
            $new_password = $request->new_password;
            $confirm_password = $request->confirm_password;
            $old_password = $request->old_password;

          
            $register = Register::where('id',$id)->where('password',md5($old_password))->count();
        
            if($register == 0){
                return response(['message'=> "Invalid Old Password"], 422);
            }
            if($new_password == $confirm_password){
                $data['password'] = md5($request->new_password);
                $data['confirm_password'] = md5($request->new_password);
                $user = Register::find($id);
                $user->update($data);
                return response(['message' => "Password Changed Successfully"], 200);
            }
            else{
                $response = ["message" => "Password is mismatch."];
                return response($response, 422);
            }
            //return response(['profile' => $orders], 200);
        }
        else{
            $response = ["message" => "Invalid User id"];
            return response($response, 422);
        }
    }

    function get_address(Request $request) {
        $id = $this->login_check($request);
        if($id == false)  return response(['message'=> "Unauthorized"], 422);
        $results = RegisterUserAddress::where('register_id',$id)->get();
        return response(array("results" => $results),200);
    }

    function add_address(Request $request) {
        $id = $this->login_check($request);
        if($id == false)  return response(['message'=> "Unauthorized"], 422);

         $validator = Validator::make($request->all(), [
            'title'         => 'required|string',
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'address'       => 'required|string',
            'phone_code'    => 'required|string',
            'mobile'        => 'required|int',
            'postal_code'   => 'required|string',
            'country'       => 'required|int',
            'state'         => 'required|int',
        ]);

        if ($validator->fails())
        {
            return response(['message'=>$validator->errors()->all()], 422);
        }

        $register = Register::where('email',$request->email)->first();
        if($register){
            return response(['message'=> "Email id already exits."], 422);
        }

        
        $register_id = $id;
        $title = $request->title;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $address = $request->address;
        $phone_code = $request->phone_code;
        $mobile = $request->mobile;
        $postal_code = $request->postal_code;
        $country = $request->country;
        $state = @$request->state ? $request->state : "";

        $data = array(
                        'register_id'           => $register_id,
                        'title'                 => $title,
                        'first_name'            => $first_name,
                        'last_name'             => $last_name,
                        'phone_code'            => $phone_code,
                        'mobile'                => $mobile,
                        'address'               => $address,
                        'country'               => $country,
                        'state'                 => $state,
                        'postal_code'           => $postal_code,
                        'created_at'            => Carbon::now()->format("Y-m-d H:i:s")
                    );

        $results = RegisterUserAddress::create($data);
        return response(array("message" => "Successfully Added"),200);
    }

    function edit_address(Request $request) {
        $id = $this->login_check($request);
        if($id == false)  return response(['message'=> "Unauthorized"], 422);

         $validator = Validator::make($request->all(), [
            'address_id'            => 'required|int',
            'title'         => 'required|string',
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'address'       => 'required|string',
            'phone_code'    => 'required|string',
            'mobile'        => 'required|int',
            'postal_code'   => 'required|string',
            'country'       => 'required|int',
            'state'         => 'required|int',
        ]);

        if ($validator->fails())
        {
            return response(['message'=>$validator->errors()->all()], 422);
        }

        $register = Register::where('email',$request->email)->first();
        if($register){
            return response(['message'=> "Email id already exits."], 422);
        }

        $address_id =  $request->address_id;
        $register_id = $id;
        $title = $request->title;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $address = $request->address;
        $phone_code = $request->phone_code;
        $mobile = $request->mobile;
        $postal_code = $request->postal_code;
        $country = $request->country;
        $state = @$request->state ? $request->state : "";

        $data = array(
                        'register_id'           => $register_id,
                        'title'                 => $title,
                        'first_name'            => $first_name,
                        'last_name'             => $last_name,
                        'phone_code'            => $phone_code,
                        'mobile'                => $mobile,
                        'address'               => $address,
                        'country'               => $country,
                        'state'                 => $state,
                        'postal_code'           => $postal_code,
                        'created_at'            => Carbon::now()->format("Y-m-d H:i:s")
                    );

        $results = RegisterUserAddress::find($address_id)->update($data);
        return response(array("message" => "Updated Successfully"),200);
    }

    function delete_address(Request $request) {
        $id = $this->login_check($request);
        if($id == false)  return response(['message'=> "Unauthorized"], 422);

         $validator = Validator::make($request->all(), [
            'address_id'            => 'required|int',
             ]);

        if ($validator->fails())
        {
            return response(['message'=>$validator->errors()->all()], 422);
        }
        $address_id = $request->address_id;
        $results = RegisterUserAddress::find($address_id)->delete();
        return response(array("message" => "Deleted Successfully"),200);

    }

    function country(Request $request) {
        $results = Countries::get();
        return response(array("results" => $results),200);
    }

    function state(Request $request) {
        $validator = Validator::make($request->all(), [
            'country_id'           => 'required',
        ]);
        if ($validator->fails())
        {
            return response(['message'=>$validator->errors()->all()], 422);
        }
        $country_id = $request->country_id;
        $results = States::where('country_id',$country_id)->get();
        return response(array("results" => $results),200);
    }

    function login_check(Request $request) {
        $token = $request->bearerToken();
        if($token){
            $register = Register::where('api_token',$token)->first();
            //print_r($register);
            if($register){
                return $register->id;
            }
            else{
                return false;
            } 
        }
        else{
            return false;
        }
    }

}