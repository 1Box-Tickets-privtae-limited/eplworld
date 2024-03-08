<?php
    use Jenssegers\Agent\Agent;
    $agent = new Agent();
    $mobile =  $agent->isMobile();
    use Illuminate\Support\Facades\Route;
    $currentPath= Route::getFacadeRoot()->current()->uri();
    //route(Illuminate\Support\Facades\Route::currentRouteName(), $locale) //}}
   // echo $currentPath;
    //{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), App::getLocale()) }}

    use App\Http\Controllers\GeneralController;
    if(App::getLocale()  == "ar"){
        $content = File::exists('settings-ar.json');
        if(!$content){
            GeneralController::get_settings();
            header('Location: '.$_SERVER['REQUEST_URI']);
        }
        $content = json_decode(File::get('settings-ar.json'), true);  
    }
    else{
        $content = File::exists('settings.json');
        if(!$content){
            GeneralController::get_settings();
            header('Location: '.$_SERVER['REQUEST_URI']);
        }
        $content = json_decode(File::get('settings.json'), true);
    }

    //pr($content);die;
    
    $data    = @$content['setting'];
    // $country = GeneralController::countries();
    // $events  = GeneralController::events();
    $action = Route::currentRouteAction();
    $main_title = $data['title'];
    $home = 0;
    if($action == "App\Http\Controllers\HomeController@index"){
       // pr($data);
        $home = 1;
        $title = $data['title'];
        $description = $data['description'];
    }
     if(Session::get('currency') == ""){
        $currency = $data['default_currency'];
        Session::put('currency',$data['default_currency']);
    }
    else{
        $currency = Session::get('currency');
    }
    $user_country = Session::get('country');
?>
    @include('layouts.partial.head',array('mobile' => $mobile,'home' =>$home)) 
    @include('layouts.partial.mobile_header') 
    @yield('content')
    @include('layouts.partial.mobile_footer') 
    @include('layouts.partial.modal') 
    @include('layouts.partial.scripts') 
    @stack('scripts')
</body>
</html>