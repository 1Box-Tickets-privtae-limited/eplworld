@php $contact_phone =  str_replace(' ', '', $data['contact_phone']);
 $contact_phone  = ltrim($contact_phone,'+');
@endphp



<style>
.navbar-nav li:hover > ul.dropdown-menu {
    display: block;
}
.dropdown-submenu {
    position:relative;
}
.dropdown-submenu > .dropdown-menu {
/*    top: 0;*/
    left: 100%;
    margin-top:-50px;
}

/* rotate caret on hover */
.dropdown-menu > li > a:hover:after {
    text-decoration: underline;
    transform: rotate(-90deg);
} 
.side-menu{
    height: 314px;
}
</style>


<!-- Header Area Start -->
    <section class="onebox-header-area">
        <div class="header-top-area">
            <!-- <div class="header-top-overlay"></div> -->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <!-- <div class="header-top-left">
                            <div class="trust-pilot">
                                    <img src="{{asset('/')}}/public/img/trustpilot1.png" alt="trustpilot">
                            </div>
                        </div> -->
                    </div>
                    <div class="col-sm-8">
                        <div class="header-top-right">
                            <div class="powered_by">
                                <p>{{__('messages.Powered By')}} <a href="https://www.1boxoffice.com/{{app()->getLocale()}}/" target="_blank"> <img src="{{asset('/')}}/public/img/new_img/logo_1.svg"></a></p>
                            </div>
                            <div class="track-order mob-hide">
                                <a class="btn btn-track" href="{{ url(app()->getLocale().'/trackorder')}}">Track Order</a>
                            </div>
                           <!--  <div class="dropdown">
                            <button class="btn-dropdown dropdown-toggle" type="button" id="dropdownlang" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img alt="" src="{{asset('/')}}/public/img/new_img/eng.png">ENG
                                <i class="fas fa-caret-down"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownlang">
                                <li><img alt="" src="{{asset('/')}}/public/img/new_img/eng.png">ENG</li>
                                <li><img alt="" src="{{asset('/')}}/public/img/new_img/eng.png">BRA</li>
                                <li><img alt="" src="{{asset('/')}}/public/img/new_img/eng.png">FRA</li>
                            </ul>
                            </div> -->

                           <div class="dropdown lang_select">
                                <button class="btn-dropdown dropdown-toggle" type="button" id="dropdownlang" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 @if($data['language'])
                                            @foreach($data['language'] as $list)
                                                @if($list['language_code'] != App::getLocale() )
                                                    <img alt="{{__('messages.'.strtolower($list['language_name']))}}" width="18px" src="{{$list['language_flag']}}">{{__('messages.'.strtolower($list['language_name']))}} </li>
                                               
                                                @endif
                                            @endforeach
                                        @endif
                                    <i class="fas fa-caret-down"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownlang">
                                      @if($data['language'])
                                            @foreach($data['language'] as $list)

                                    <li><a href="{{str_replace('/'.app()->getLocale(),'/'.$list['language_code'], url()->full())}}" ><img alt="" src="{{$list['language_flag']}}" width="18px">{{__('messages.'.strtolower($list['language_name']))}} </a></li>
                                     @endforeach
                                        @endif
                                </ul>
                            </div>
                          
                            <!-- <div class="dropdown">
                                 <button class="btn-dropdown dropdown-toggle" type="button" id="">
                                    @if($data['language'])
                                        @foreach($data['language'] as $list)
                                            @if($list['language_code'] != App::getLocale() )
                                                <a class="nav-link"
                                                    href="{{str_replace('/'.app()->getLocale(),'/'.$list['language_code'], url()->full())}}">
                                                <li><img alt="{{__('messages.'.strtolower($list['language_name']))}}" src="{{$list['language_flag']}}">{{__('messages.'.strtolower($list['language_name']))}} </li>
                                            </a>
                                            @endif
                                        @endforeach
                                    @endif
                                </button>
                            </div> -->

                            <div class="dropdown curr_select">
                                <button class="btn-dropdown dropdown-toggle" type="button" id="dropdowncur" data-toggle="dropdown" aria-haspopup="true">
                                 @if($data)
                                        @foreach($data['currency'] as $list) 
                                        @if(@$currency == $list['currency_code'])
                                             <b>{{$list['symbol']}} </b>{{$list['currency_code']}}
                                            @endif
                                        @endforeach
                                    @endif
                                    <i class="fas fa-caret-down"></i>
                                </button>
                                <ul class="dropdown-menu currency" aria-labelledby="dropdowncur">
                                    @if($data)
                                        @foreach($data['currency'] as $list) 
                                            <li data-code="{{$list['currency_code']}}"> <b>{{$list['symbol']}} </b>{{$list['currency_code']}}</li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>

                             @if(Session::get('cart_quantity'))
                            <a href="{{ url(app()->getLocale().'/checkout')}}" class="header-cart">
                                <i class="fa fa-shopping-cart"></i>
                                {{__('messages.cart')}} <span>{{Session::get('cart_quantity')}}</span>
                            </a>
                            @endif
                            <!-- <a href="{{ url(app()->getLocale().'/sell-your-tickets')}}" class="header-partnership">
                            {{__('messages.sell tickets')}}
                            </a> -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-mainmenu-area">
            <div class="container">
                <div class="onebox-desktop-menu">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="onebox-site-logo">
                                <!-- <div class="responsive-menu-2"></div> -->
                                <div class="header">
                                    <div class="wrapper cf">
                                        <nav id="main-nav">
                                            <ul class="first-nav">
                                                <li><a href="{{ url(App::getLocale())}}" rel="noreferrer">{{__('messages.home')}}</a></li>
                                                <li class="">
                                                    <a href="#" rel="noreferrer" target="_blank">{{__('messages.tournaments')}}</a>
                                                    <ul id="">
                                                        <li class="tournaments_menu_mobile" id="tournaments_menu_mobile"><a href="{{ url(App::getLocale().'/tournament-tickets')}}">View All</a></li>
                                                    </ul>
                                                </li>
                                                <li class="">
                                                    <a href="#" rel="noreferrer" target="_blank">{{__('messages.top teams')}}</a>
                                                    <ul>
                                                        <li class="team_menu"> <a href="{{ url(App::getLocale().'/top-teams-tickets')}}">View All</a></li>
                                                    </ul>
                                                </li>
                                               <!--  <li class="">
                                                    <a  href="{{ url(App::getLocale().'/other-events-tickets')}}"  rel="noreferrer"  class="oe_list_mob" >{{__('messages.other events')}}</a>  
                                                </li> -->
                                                <li class="">
                                                    <a href="{{url(app()->getLocale().'/advance-search')}}">{{__('messages.search by destination')}}</a>
                                                </li>
                                                <li class="">
                                                    <a href="{{url(app()->getLocale().'/faq')}}">{{__('messages.faq/help')}}</a>
                                                </li>

                                                @if(Session::get('user_token') =="")
        
                                                <li class="">
                                                    <a  href="{{url(app()->getLocale().'/login')}}" >{{__('messages.login')}}</a>
                                                </li>
                                                <li class="">
                                                     <a href="{{url(app()->getLocale().'/register')}}" >{{__('messages.sign up')}}</a>
                                                </li>
                                                @else
                                                <li class="">
                                                    <a href="{{url(app()->getLocale().'/profile')}}">{{__('messages.dashboard')}}</a>
                                                </li>
                                                <li class="">
                                                    <a href="{{url(app()->getLocale().'/orders')}}">{{__('messages.orders')}}</a>
                                                </li>
                                                <li class="">
                                                    <a href="{{url(app()->getLocale().'/logout')}}">{{__('messages.logout')}}</a>
                                                </li>
                                                @endif
                                               
                            
                                            </ul>
                                        </nav>
                                        <a class="toggle" href="#">
                                        <span></span>
                                        </a>
                                    </div>
                                </div> 
                                <div class="logo_area">
                                    <!-- <a href="{{url(app()->getLocale())}}" class="onebox-site-logo"> -->
                                        <a href="https://eplworld.com/en" class="onebox-site-logo">
                                        <img  src="{{$data['logo']}}" alt="" />
                                    </a>
                                </div>
                                <div class="user_login">
                                    <ul>
                                        <li>
                                            <div class="search-icon-mobile">
                                                <a href="{{url(app()->getLocale().'/advance-search')}}"><i class="fas fa-search"></i></a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="user-icon-mobile">
                                                <a href="{{url(app()->getLocale().'/login')}}"><i class="fas fa-user"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- <div class="responsive-menu-1"></div> -->
                            </div>
                            <div class="mainmenu-left">
                                <nav class="navbar navbar-expand-md navbar-light bg-light">
                                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                        <ul class="navbar-nav " id="navigation_menu">
                                           <li class="nav-item">
                                                <a class="nav-link" href="{{url(App::getLocale())}}" > {{__('messages.home')}}</a>
                                            </li>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="{{url(App::getLocale().'/tournament-tickets')}}" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{__('messages.tournaments')}}   <i class="fa fa-caret-down"></i></a>
                                                <ul class="dropdown-menu tournaments_menu" aria-labelledby="navbarDropdownMenuLink">
                                                </ul>
                                            </li>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{__('messages.top teams')}} <i class="fa fa-caret-down"></i></a>
                                                <ul class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
                                                  <li class="dropdown-submenu team_menu"><a class="dropdown-item dropdown-toggle" href="{{ url(App::getLocale().'/top-teams-tickets')}}">{{__('messages.view all')}}</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="{{url(app()->getLocale().'/faq')}}">{{__('messages.faq/help')}}</a>
                                            </li>
                                           <!--  <li>
                                                <a href="{{url(app()->getLocale().'/other-events-tickets')}}">{{__('messages.other events')}}</a>
                                            </li> -->
                                             @if(@$homepage)
                                                 <li class="serach_option">
                                                    <a href="{{url(app()->getLocale().'/advance-search')}}"><i class="fas fa-search"></i></a>
                                                </li>
                                          
                                                @else
                                                <li class="dropp">
                                                    <div class="show_drop">
                                                        <form autocomplete="off" action="{{url(app()->getLocale().'/advance-search')}}"method="get">
                                                            <div class="search-form-group search-result-filter-top">
                                                                <input type="search" name="keywords" id="all_page_events" value="" placeholder="{{__('messages.search bar placeholder')}}">
                                                                <button type="submit" class="search-button">
                                                                    <i class="fa fa-search"></i>
                                                                </button>
                                                            </div>
                                                           <div class="all-search-page"></div>
                                                        </form>
                                                    </div>
                                                </li>
                                                 
                                                @endif
                                            <!-- <li>
                                                <a href="{{url(app()->getLocale().'/advance-search')}}">{{__('messages.search by destination')}}</a>
                                            </li> -->
                                           
                                            @if(Session::get('user_token') =="")                                      
                                            <li class="log_inn">
                                                <a href="{{url(app()->getLocale().'/login')}}" >{{__('messages.login')}}</a>
                                            </li>
                                            <!-- <li>
                                                <a href="#"  data-toggle="modal" data-target="#onebox-register-modal">{{__('messages.sign up')}}</a>
                                            </li> -->
                                            @else

                                            <li class="nav-item dropdown user">
                                              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{url('/')}}/public/img/user.png">{{Session::get('first_name')  }} <i class="fa fa-caret-down"></i>
                                              </a>
                                              <ul class="dropdown-menu">
                                                <li class="dropdown-submenu"><a class="dropdown-item" href="{{url(app()->getLocale().'/profile')}}">{{__('messages.dashboard')}}</a></li>
                                                <li class="dropdown-submenu"><a class="dropdown-item" href="{{url(app()->getLocale().'/orders')}}">{{__('messages.orders')}}</a></li>
                                                <li class="dropdown-submenu"><a class="dropdown-item" href="{{url(app()->getLocale().'/logout')}}">{{__('messages.logout')}}</a></li>
                                              </ul>
                                            </li>

                                            <!-- <li>
                                                <a href="{{url(app()->getLocale().'/profile')}}">{{__('messages.dashboard')}}</a>
                                            </li>
                                            <li class="log_orders">
                                                <a href="{{url(app()->getLocale().'/orders')}}">{{__('messages.orders')}}</a>
                                            </li>
                                            <li>
                                                <a href="{{url(app()->getLocale().'/logout')}}">{{__('messages.logout')}}</a>
                                            </li> -->
                                            @endif
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Header Area End -->