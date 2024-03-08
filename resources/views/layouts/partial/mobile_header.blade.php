<style type="text/css">
    body.theme-default .hc-offcanvas-nav a.nav-next{
        border-bottom: 0;
    }
</style>
<!--Header Area Start -->
    <section class="onebox-header-area">  
        <div class="header-mainmenu-area">
            <div class="container">
                <div class="onebox-desktop-menu">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="head-mobile-lft">
                                    <div class="header-top-left">
                                        <ul>
                                          <!--   <li><a title="English WhatsApp" href="https://api.whatsapp.com/send?phone=447498070285" target="blank_"><i class="fas fa-phone-alt"></i><span class="numb">{{$data['contact_phone']}}</span></a></li> -->
                                            <li> @if(Session::get('user_token') =="")<a href="#" data-toggle="modal" id="loginModal" data-target="#onebox-login-modal">Login</a> @else <a href="{{url(app()->getLocale().'/profile')}}">{{__('messages.dashboard')}}</a> @endif</li>
                                            <!-- <li><a href="#" data-toggle="modal" data-target="#onebox-register-modal" role="menuitem" tabindex="-1"><i class="fas fa-sign-in"></i></a></li> -->
                                        </ul>
                                    </div>
                                <!-- <div class="header-top-left">
                                    <div class="whats_app">
                                    <a title="English WhatsApp" href="https://api.whatsapp.com/send?phone=https://api.whatsapp.com/send?phone={{$data['contact_phone']}}" target="blank_"><i class="fas fa-phone-alt"></i><span class="numb">{{$data['contact_phone']}}</span></a>
                                    </div>
                                    <div class="sign_in"><a href="#" data-toggle="modal" data-target="#onebox-login-modal"><i class="fas fa-user"></i></a></div>
                                    <div class="sign_up">
                                        <a href="#" data-toggle="modal" data-target="#onebox-register-modal">Sign up</a>
                                    </div>
                                </div> -->
                            </div>

                            <div class="onebox-site-logo">
                                
                                <div class="logo_area">
                                 <a href="https://eplworld.com/en" class="onebox-site-logo">
                                        <img src="{{$data['logo']}}" alt="" />
                                    </a>
                                </div>
                                <!-- <div class="responsive-menu-1"></div> -->
                            </div>
                            <div class="head-mobile-rit">
                                <div class="cart">
                                    @if(Session::get('cart_quantity'))
                                    <a href="{{ url(app()->getLocale().'/checkout')}}" class="header-cart">
                                    <i class="fa fa-shopping-cart"></i>
                                     <span>{{Session::get('cart_quantity')}}</span>
                                    </a>
                                     @endif
                                </div>

                                <div class="dropdown">
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

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-top-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="head-mobile-lft">
                            <div class="header-top-right">

                                <div class="dropdown">
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
                                  <!--   <button class="btn-dropdown dropdown-toggle" type="button" id="dropdownlang" data-toggle="dropdown" aria-haspopup="true">
                                    @if($data['language'])
                                            @foreach($data['language'] as $list)
                                                @if($list['language_code'] != App::getLocale() )
                                                    <a class="nav-link"
                                                        href="{{str_replace('/'.app()->getLocale(),'/'.$list['language_code'],Request::url())}}">
                                                    <li><img alt="" src="{{$list['language_flag']}}">{{$list['language_name']}} <i class="fas fa-caret-down"></i></li>
                                                </a>
                                                @endif
                                            @endforeach
                                        @endif
                                      
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownlang">
                                        @if($data['language'])
                                            @foreach($data['language'] as $list)
                                                 <a class="nav-link"
                                                        href="{{str_replace('/'.app()->getLocale(),'/'.$list['language_code'],Request::url())}}">
                                                <li><img alt="" src="{{$list['language_flag']}}">{{$list['language_name']}}</li>
                                            </a>
                                            @endforeach
                                        @endif
                                    </ul> -->
                                </div>                            
                            </div>
                        </div>

                        <div class="head-mobile-rit">
                                <div class="header">

                                    <div class="wrapper cf">


                                    
                                        <nav id="main-nav" >
                                            <ul class="first-nav">
                                                <li class="">
                                                    <a href="#" rel="noreferrer" target="_blank">{{__('messages.home')}}</a>
                                                </li>
                                                <li class="">
                                                    <a href="#" rel="noreferrer" target="_blank">{{__('messages.tournaments')}}</a>
                                                    <ul id="tournaments_menu_mobile">
                                                        
                                                    </ul>
                                                </li>
                                                <li class="">
                                                    <a href="#" rel="noreferrer" target="_blank">{{__('messages.top teams')}}</a>
                                                    <ul>
                                                        <li class="team_menu"> <a href="{{ url(App::getLocale().'/top-teams-tickets')}}">View All</a></li>
                                                    </ul>
                                                </li>
                                                <li class="">
                                                    <a href="{{url(app()->getLocale().'/other-events-tickets')}}">{{__('messages.other events')}}</a>
                                                </li>
                                                <li class="">
                                                    <a href="{{url(app()->getLocale().'/advance-search')}}">{{__('messages.search by destination')}}</a>
                                                </li>
                                                <li class="">
                                                    <a href="{{url(app()->getLocale().'/faq')}}">{{__('messages.faq/help')}}</a>
                                                </li>

                                                @if(Session::get('user_token') =="")
        
                                        <li class="">
                                            <a href="javascript:void(0)"  class="login_modal" >{{__('messages.login')}}</a>
                                        </li>
                                        <li class="">
                                             <a href="javascript:void(0)"   class="register_modal" >{{__('messages.sign up')}}</a>
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
                                           <li class="">
                                               <a href="{{ url(app()->getLocale().'/sell-your-tickets')}}" class="header-partnership">
                                                    {{__('messages.sell tickets')}}
                                                    </a>
                                            </li>
                            
                                            </ul>
                                        </nav>
                                        <a class="toggle" href="#">
                                        <span></span>
                                        </a>
                                    </div>
                                </div> 


                                @if(@Route::current()->getName() != "homepage")
                                <div class="search_top_bar">
                                    <div class="search_bar">
                                        <div class="btn_srch" data-toggle="modal" data-target="#myModal_search"><i class="fa fa-search"></i></div>
                                        <!-- <button type="button" class="btn_srch" data-toggle="modal" data-target="#myModal_search"><i class="fa fa-search"></i></button> -->
                                    </div>
                                    <div class="modal fade" id="myModal_search" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                <div class="modal-body">
                                                    <div class="header-search-box">
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Header Area End -->