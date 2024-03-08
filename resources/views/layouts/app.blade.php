<?php
    use Jenssegers\Agent\Agent;
    use App\Http\Controllers\GeneralController;
    $agent = new Agent();
    $mobile =  "";
    use Illuminate\Support\Facades\Route;
    $currentPath= @Route::getFacadeRoot()->current();
    $currentPath = @$currentPath ? $currentPath->uri() : "";
    //route(Illuminate\Support\Facades\Route::currentRouteName(), $locale) //}}
   // echo $currentPath;
    //{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), App::getLocale()) }}
     $domain_key = $_SERVER['SERVER_NAME'];
    if(App::getLocale()  == "ar"){
        $content = File::exists('settings-'.$domain_key.'-ar.json');
        if(!$content){
            GeneralController::get_settings();
            header('Location: '.$_SERVER['REQUEST_URI']);
        }
        $content = json_decode(File::get('settings-'.$domain_key.'-ar.json'), true);  
    }
    else{
        $content = File::exists('settings-'.$domain_key.'.json');
        if(!$content){
            GeneralController::get_settings();
            header('Location: '.$_SERVER['REQUEST_URI']);
        }
        $content = json_decode(File::get('settings-'.$domain_key.'.json'), true);
    }
    //pr($content);die;
    $data    = @$content['setting'];
    
    //$country = GeneralController::countries();
    //$events  = GeneralController::events();
    $action = Route::currentRouteAction();
    $main_title = @$data['title'];
    if($action == "App\Http\Controllers\HomeController@index"){
       // pr($data);
        $title = @$data['title'];
        $description = @$data['description'];
    }
     if(Session::get('currency') == ""){
        $currency = $data['default_currency'];
        Session::put('currency',$data['default_currency']);
    }
    else{
        $currency = Session::get('currency');
    }
    $user_country = Session::get('country');
    $remember = !empty($_COOKIE['rememberme'])?json_decode(base64_decode($_COOKIE['rememberme']),true):"";
?>

    @if(@$data['site_status'] == "0")
    <h2 align="center">Domain Is Inactive</h2>
    @php die; @endphp 
    @endif

    @include('layouts.partial.head',array('mobile' => $mobile)) 
    @if($mobile == true)  @include('layouts.partial.mobile_header') @else @include('layouts.partial.desktop_header')  @endif

   
    @yield('content')
    @if($mobile == true) @include('layouts.partial.mobile_footer') @else @include('layouts.partial.desktop_footer')  @endif
    @include('layouts.partial.modal') 
    @include('layouts.partial.scripts')
    
    @stack('scripts')
</body>
</html>