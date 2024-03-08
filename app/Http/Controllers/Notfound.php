<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Storage;
use Hash;
use Session;
use Auth;
use DB;
use Socialite;
use Response;
use ZipArchive;

use App\Models\ApiKeySetting;

class Notfound extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
     public function notfound()
    { 
        return view('frontend.payment.notfound');
    }

     public function invalid()
    { 
        return view('frontend.payment.invalid');
    }

    public function expired()
    { 
        return view('frontend.payment.expired');
    }

    
}